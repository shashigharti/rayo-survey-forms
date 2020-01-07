(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

importScripts('idb.js');
self.addEventListener('message', function (e) {
    var message = e.data;
    // Initiate IndexedDB instance
    fns.init();

    if (message[0] === "storeInLocal") {
        fns.addIndexedData(fns.dbPromise, message[1]).then(function () {
            // Send data back to the main thread
            self.postMessage({ type: 'storeInLocal', status: true });
        }).catch(function (err) {
            self.postMessage({ type: 'storeInLocal', status: false });
        });
    } else if (message[0] === "syncToLive") {
        fns.syncToLive(fns.dbPromise, message[1]);
    } else if (message[0] === "syncForms") {
        fns.syncForms(fns.dbPromise);
    } else if (message[0] === "getForm") {
        var id = message[1];
        console.log("Getting form with slug: " + id);
        // fns.getItem(fns.dbPromise, slug, 'mis_forms').then(function (data) {
        //     self.postMessage({type: 'getForm', data: data});
        // });
        var dbPromise = idb.open('mis', 5);
        dbPromise.then(function (db) {
            return db.transaction('mis_forms').objectStore('mis_forms').get(parseInt(id));
        }).then(function (obj) {
            self.postMessage({ type: 'getForm', data: obj });
        });
    } else if (message[0] === "getAllForms") {
        console.log("Getting All Forms");
        fns.getLocalData(fns.dbPromise, 'mis_forms').then(function (data) {
            self.postMessage({ type: 'getAllForms', data: data });
        });
    }
});

var fns = {
    dbPromise: null,
    options: {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": ''
        },
        method: 'post',
        credentials: "same-origin",
        body: ''
    },
    init: function init() {
        // Create Indexed DB / Get Instance if exists
        fns.dbPromise = idb.open('mis', 5, function (upgradeDb) {
            switch (upgradeDb.oldVersion) {
                case 0:
                // a placeholder case so that the switch block will
                // execute when the database is first created
                // (oldVersion is 0)
                case 1:
                    console.log("Case 1");
                    upgradeDb.createObjectStore('mis_surveys', { keyPath: 'key', autoIncrement: true });
                case 2:
                    console.log('Creating mis_surveys object store');
                    var store = upgradeDb.transaction.objectStore('mis_surveys');
                    store.createIndex('id', 'id', { unique: true });
                case 3:
                    console.log('Creating mis_forms object store');
                    upgradeDb.createObjectStore('mis_forms', { keyPath: 'id' });
                case 4:
                    var store = upgradeDb.transaction.objectStore('mis_forms');
                // store.createIndex('id', 'id');
            }
        });
    },
    getData: function getData(page) {
        $.post('/all_data', { search_type: 'data', token: token, page: page }, function (allSurveys) {
            // Sync data to local DB for offline usage
            if (allSurveys.length !== 0) {
                // Add new data to table, if exists replace them
                fns.addIndexedData(fns.dbPromise, allSurveys).then(function (resp) {
                    self.postMessage(resp);
                    fns.getData(++page); // Get data from next page when add complete
                }).catch(function (err) {
                    console.log(err);
                });
            }
        });
    },
    getLocalData: function getLocalData(dbPromise) {
        var objectStore = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'mis_surveys';

        return new Promise(function (resolve, reject) {
            dbPromise.then(function (db) {
                var tx = db.transaction(objectStore, 'readonly');
                var store = tx.objectStore(objectStore);
                return store.getAll();
            }).then(function (data) {
                resolve(data);
            }).catch(function (err) {
                reject("Failed to get all data. Err: " + err);
            });
        });
    },
    addIndexedData: function addIndexedData(dbPromise, newData) {
        var objectStore = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'mis_surveys';

        return new Promise(function (resolve, reject) {
            dbPromise.then(function (db) {
                var tx = db.transaction(objectStore, 'readwrite');
                var store = tx.objectStore(objectStore);
                return store.put(newData).catch(function (e) {
                    tx.abort();
                    reject(e);
                }).then(function () {
                    resolve('Data added to indexedDB successfully.');
                });
            });
        });
    },
    getItem: function getItem(dbPromise, key) {
        var objectStore = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'mis_surveys';

        return new Promise(function (resolve, reject) {
            dbPromise.then(function (db) {
                var tx = db.transaction(objectStore, 'readonly');
                var store = tx.objectStore(objectStore);
                return store.get(key).catch(function (e) {
                    tx.abort();
                    reject(e);
                }).then(function (data) {
                    resolve(data);
                });
            });
        });
    },
    // Delete all data from object store
    truncateObjectStore: function truncateObjectStore(dbPromise) {
        var objectStore = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'mis_surveys';

        dbPromise.then(function (db) {
            var tx = db.transaction(objectStore, 'readwrite');
            var store = tx.objectStore(objectStore);
            return store.clear().catch(function (e) {
                tx.abort();
                console.log(e);
            }).then(function () {
                console.log('All Data from Object store: ' + objectStore + ' have been truncated.');
            });
        });
    },
    // Add Data to Indexed DB
    addBulkIndexedData: function addBulkIndexedData(dbPromise, newData) {
        var objectStore = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'mis_surveys';

        return new Promise(function (resolve, reject) {
            dbPromise.then(function (db) {
                var tx = db.transaction(objectStore, 'readwrite');
                var store = tx.objectStore(objectStore);
                return Promise.all(newData.map(function (item) {
                    return store.put(item);
                })).catch(function (e) {
                    tx.abort();
                    console.log(e);
                }).then(function () {
                    console.log('Synced to local successfully');
                });
            });
        });
    },
    syncToLive: function syncToLive(dbPromise, token) {

        fns.getLocalData(dbPromise).then(function (data) {
            delete data.id; // Don't include id used by indexed db
            fns.options.body = JSON.stringify(data);
            fns.options.headers['X-CSRF-TOKEN'] = token;
            fetch('/api/sync', fns.options).then(function (response) {
                // Delete local data after successful sync
                fns.truncateObjectStore(dbPromise);
            }).catch(function (error) {
                console.log(error);
            });
        }).catch(function (err) {
            console.log("Failed to sync " + err);
        });
    },
    syncForms: function syncForms(dbPromise) {
        fns.getForms().then(function (data) {
            fns.addBulkIndexedData(dbPromise, data, 'mis_forms');

            fns.getItem(dbPromise, 'test-form', 'mis_forms').then(function (data) {
                console.log(data);
            }).catch(function (err) {
                console.log(err);
            });
        });
    },
    getForms: function getForms() {
        return new Promise(function (resolve, reject) {
            fetch('/admin/user/getAllForms').then(function (data) {
                return data.json();
            }).then(function (jsonString) {
                resolve(jsonString);
            });
        });
    }

};
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImZha2VfOGYyM2ZkYmQuanMiXSwibmFtZXMiOlsiaW1wb3J0U2NyaXB0cyIsInNlbGYiLCJhZGRFdmVudExpc3RlbmVyIiwiZSIsIm1lc3NhZ2UiLCJkYXRhIiwiZm5zIiwiaW5pdCIsImFkZEluZGV4ZWREYXRhIiwiZGJQcm9taXNlIiwidGhlbiIsInBvc3RNZXNzYWdlIiwidHlwZSIsInN0YXR1cyIsImNhdGNoIiwiZXJyIiwic3luY1RvTGl2ZSIsInN5bmNGb3JtcyIsImlkIiwiY29uc29sZSIsImxvZyIsImlkYiIsIm9wZW4iLCJkYiIsInRyYW5zYWN0aW9uIiwib2JqZWN0U3RvcmUiLCJnZXQiLCJwYXJzZUludCIsIm9iaiIsImdldExvY2FsRGF0YSIsIm9wdGlvbnMiLCJoZWFkZXJzIiwibWV0aG9kIiwiY3JlZGVudGlhbHMiLCJib2R5IiwidXBncmFkZURiIiwib2xkVmVyc2lvbiIsImNyZWF0ZU9iamVjdFN0b3JlIiwia2V5UGF0aCIsImF1dG9JbmNyZW1lbnQiLCJzdG9yZSIsImNyZWF0ZUluZGV4IiwidW5pcXVlIiwiZ2V0RGF0YSIsInBhZ2UiLCIkIiwicG9zdCIsInNlYXJjaF90eXBlIiwidG9rZW4iLCJhbGxTdXJ2ZXlzIiwibGVuZ3RoIiwicmVzcCIsIlByb21pc2UiLCJyZXNvbHZlIiwicmVqZWN0IiwidHgiLCJnZXRBbGwiLCJuZXdEYXRhIiwicHV0IiwiYWJvcnQiLCJnZXRJdGVtIiwia2V5IiwidHJ1bmNhdGVPYmplY3RTdG9yZSIsImNsZWFyIiwiYWRkQnVsa0luZGV4ZWREYXRhIiwiYWxsIiwibWFwIiwiaXRlbSIsIkpTT04iLCJzdHJpbmdpZnkiLCJmZXRjaCIsInJlc3BvbnNlIiwiZXJyb3IiLCJnZXRGb3JtcyIsImpzb24iLCJqc29uU3RyaW5nIl0sIm1hcHBpbmdzIjoiOztBQUFBQSxjQUFjLFFBQWQ7QUFDQUMsS0FBS0MsZ0JBQUwsQ0FBc0IsU0FBdEIsRUFBaUMsVUFBVUMsQ0FBVixFQUFhO0FBQzFDLFFBQUlDLFVBQVVE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cmNlc0NvbnRlbnQiOlsiaW1wb3J0U2NyaXB0cygnaWRiLmpzJyk7XG5zZWxmLmFkZEV2ZW50TGlzdGVuZXIoJ21lc3NhZ2UnLCBmdW5jdGlvbiAoZSkge1xuICAgIGxldCBtZXNzYWdlID0gZS5kYXRhO1xuICAgIC8vIEluaXRpYXRlIEluZGV4ZWREQiBpbnN0YW5jZVxuICAgIGZucy5pbml0KCk7XG5cbiAgICBpZiAobWVzc2FnZVswXSA9PT0gXCJzdG9yZUluTG9jYWxcIikge1xuICAgICAgICBmbnMuYWRkSW5kZXhlZERhdGEoZm5zLmRiUHJvbWlzZSwgbWVzc2FnZVsxXSkudGhlbihmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAvLyBTZW5kIGRhdGEgYmFjayB0byB0aGUgbWFpbiB0aHJlYWRcbiAgICAgICAgICAgIHNlbGYucG9zdE1lc3NhZ2Uoe3R5cGU6ICdzdG9yZUluTG9jYWwnLCBzdGF0dXM6IHRydWV9KTtcbiAgICAgICAgfSkuY2F0Y2goZnVuY3Rpb24gKGVycikge1xuICAgICAgICAgICAgc2VsZi5wb3N0TWVzc2FnZSh7dHlwZTogJ3N0b3JlSW5Mb2NhbCcsIHN0YXR1czogZmFsc2V9KTtcbiAgICAgICAgfSk7XG4gICAgfSBlbHNlIGlmIChtZXNzYWdlWzBdID09PSBcInN5bmNUb0xpdmVcIikge1xuICAgICAgICBmbnMuc3luY1RvTGl2ZShmbnMuZGJQcm9taXNlLCBtZXNzYWdlWzFdKTtcbiAgICB9IGVsc2UgaWYgKG1lc3NhZ2VbMF0gPT09IFwic3luY0Zvcm1zXCIpIHtcbiAgICAgICAgZm5zLnN5bmNGb3JtcyhmbnMuZGJQcm9taXNlKTtcbiAgICB9IGVsc2UgaWYgKG1lc3NhZ2VbMF0gPT09IFwiZ2V0Rm9ybVwiKSB7XG4gICAgICAgIGxldCBpZCA9IG1lc3NhZ2VbMV07XG4gICAgICAgIGNvbnNvbGUubG9nKFwiR2V0dGluZyBmb3JtIHdpdGggc2x1ZzogXCIgKyBpZCk7XG4gICAgICAgIC8vIGZucy5nZXRJdGVtKGZucy5kYlByb21pc2UsIHNsdWcsICdtaXNfZm9ybXMnKS50aGVuKGZ1bmN0aW9uIChkYXRhKSB7XG4gICAgICAgIC8vICAgICBzZWxmLnBvc3RNZXNzYWdlKHt0eXBlOiAnZ2V0Rm9ybScsIGRhdGE6IGRhdGF9KTtcbiAgICAgICAgLy8gfSk7XG4gICAgICAgIGxldCBkYlByb21pc2UgPSBpZGIub3BlbignbWlzJywgNSk7XG4gICAgICAgIGRiUHJvbWlzZS50aGVuKGRiID0+IHtcbiAgICAgICAgICAgIHJldHVybiBkYi50cmFuc2FjdGlvbignbWlzX2Zvcm1zJylcbiAgICAgICAgICAgICAgICAub2JqZWN0U3RvcmUoJ21pc19mb3JtcycpLmdldChwYXJzZUludChpZCkpO1xuICAgICAgICB9KS50aGVuKG9iaiA9PlxuICAgICAgICB7XG4gICAgICAgICAgICBzZWxmLnBvc3RNZXNzYWdlKHsgdHlwZTogJ2dldEZvcm0nLCBkYXRhOiBvYmogfSk7XG4gICAgICAgIH0pO1xuICAgIH0gZWxzZSBpZiAobWVzc2FnZVswXSA9PT0gXCJnZXRBbGxGb3Jtc1wiKSB7XG4gICAgICAgIGNvbnNvbGUubG9nKFwiR2V0dGluZyBBbGwgRm9ybXNcIik7XG4gICAgICAgIGZucy5nZXRMb2NhbERhdGEoZm5zLmRiUHJvbWlzZSwgJ21pc19mb3JtcycpLnRoZW4oZnVuY3Rpb24oZGF0YSkge1xuICAgICAgICAgICAgc2VsZi5wb3N0TWVzc2FnZSh7dHlwZTogJ2dldEFsbEZvcm1zJywgZGF0YTogZGF0YX0pO1xuICAgICAgICB9KVxuICAgIH1cblxufSk7XG5cbmNvbnN0IGZucyA9IHtcbiAgICBkYlByb21pc2U6IG51bGwsXG4gICAgb3B0aW9uczoge1xuICAgICAgICBoZWFkZXJzOiB7XG4gICAgICAgICAgICBcIkNvbnRlbnQtVHlwZVwiOiBcImFwcGxpY2F0aW9uL2pzb25cIixcbiAgICAgICAgICAgIFwiQWNjZXB0XCI6IFwiYXBwbGljYXRpb24vanNvbiwgdGV4dC1wbGFpbiwgKi8qXCIsXG4gICAgICAgICAgICBcIlgtUmVxdWVzdGVkLVdpdGhcIjogXCJYTUxIdHRwUmVxdWVzdFwiLFxuICAgICAgICAgICAgXCJYLUNTUkYtVE9LRU5cIjogJydcbiAgICAgICAgfSxcbiAgICAgICAgbWV0aG9kOiAncG9zdCcsXG4gICAgICAgIGNyZWRlbnRpYWxzOiBcInNhbWUtb3JpZ2luXCIsXG4gICAgICAgIGJvZHk6ICcnXG4gICAgfSxcbiAgICBpbml0OiAoKSA9PiB7XG4gICAgICAgIC8vIENyZWF0ZSBJbmRleGVkIERCIC8gR2V0IEluc3RhbmNlIGlmIGV4aXN0c1xuICAgICAgICBmbnMuZGJQcm9taXNlID0gaWRiLm9wZW4oJ21pcycsIDUsIGZ1bmN0aW9uICh1cGdyYWRlRGIpIHtcbiAgICAgICAgICAgIHN3aXRjaCAodXBncmFkZURiLm9sZFZlcnNpb24pIHtcbiAgICAgICAgICAgICAgICBjYXNlIDA6XG4gICAgICAgICAgICAgICAgLy8gYSBwbGFjZWhvbGRlciBjYXNlIHNvIHRoYXQgdGhlIHN3aXRjaCBibG9jayB3aWxsXG4gICAgICAgICAgICAgICAgLy8gZXhlY3V0ZSB3aGVuIHRoZSBkYXRhYmFzZSBpcyBmaXJzdCBjcmVhdGVkXG4gICAgICAgICAgICAgICAgLy8gKG9sZFZlcnNpb24gaXMgMClcbiAgICAgICAgICAgICAgICBjYXNlIDE6XG4gICAgICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKFwiQ2FzZSAxXCIpO1xuICAgICAgICAgICAgICAgICAgICB1cGdyYWRlRGIuY3JlYXRlT2JqZWN0U3RvcmUoJ21pc19zdXJ2ZXlzJywge2tleVBhdGg6ICdrZXknLCBhdXRvSW5jcmVtZW50OiB0cnVlfSk7XG4gICAgICAgICAgICAgICAgY2FzZSAyOlxuICAgICAgICAgICAgICAgICAgICBjb25zb2xlLmxvZygnQ3JlYXRpbmcgbWlzX3N1cnZleXMgb2JqZWN0IHN0b3JlJyk7XG4gICAgICAgICAgICAgICAgICAgIHZhciBzdG9yZSA9IHVwZ3JhZGVEYi50cmFuc2FjdGlvbi5vYmplY3RTdG9yZSgnbWlzX3N1cnZleXMnKTtcbiAgICAgICAgICAgICAgICAgICAgc3RvcmUuY3JlYXRlSW5kZXgoJ2lkJywgJ2lkJywge3VuaXF1ZTogdHJ1ZX0pO1xuICAgICAgICAgICAgICAgIGNhc2UgMzpcbiAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2coJ0NyZWF0aW5nIG1pc19mb3JtcyBvYmplY3Qgc3RvcmUnKTtcbiAgICAgICAgICAgICAgICAgICAgdXBncmFkZURiLmNyZWF0ZU9iamVjdFN0b3JlKCdtaXNfZm9ybXMnLCB7a2V5UGF0aDogJ2lkJ30pO1xuICAgICAgICAgICAgICAgIGNhc2UgNDpcbiAgICAgICAgICAgICAgICAgICAgdmFyIHN0b3JlID0gdXBncmFkZURiLnRyYW5zYWN0aW9uLm9iamVjdFN0b3JlKCdtaXNfZm9ybXMnKTtcbiAgICAgICAgICAgICAgICAvLyBzdG9yZS5jcmVhdGVJbmRleCgnaWQnLCAnaWQnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfSxcbiAgICBnZXREYXRhOiAocGFnZSkgPT4ge1xuICAgICAgICAkLnBvc3QoJy9hbGxfZGF0YScsIHtzZWFyY2hfdHlwZTogJ2RhdGEnLCB0b2tlbjogdG9rZW4sIHBhZ2U6IHBhZ2V9LCBmdW5jdGlvbiAoYWxsU3VydmV5cykge1xuICAgICAgICAgICAgLy8gU3luYyBkYXRhIHRvIGxvY2FsIERCIGZvciBvZmZsaW5lIHVzYWdlXG4gICAgICAgICAgICBpZiAoYWxsU3VydmV5cy5sZW5ndGggIT09IDApIHtcbiAgICAgICAgICAgICAgICAvLyBBZGQgbmV3IGRhdGEgdG8gdGFibGUsIGlmIGV4aXN0cyByZXBsYWNlIHRoZW1cbiAgICAgICAgICAgICAgICBmbnMuYWRkSW5kZXhlZERhdGEoZm5zLmRiUHJvbWlzZSwgYWxsU3VydmV5cykudGhlbihmdW5jdGlvbiAocmVzcCkge1xuICAgICAgICAgICAgICAgICAgICBzZWxmLnBvc3RNZXNzYWdlKHJlc3ApO1xuICAgICAgICAgICAgICAgICAgICBmbnMuZ2V0RGF0YSgrK3BhZ2UpOyAvLyBHZXQgZGF0YSBmcm9tIG5leHQgcGFnZSB3aGVuIGFkZCBjb21wbGV0ZVxuICAgICAgICAgICAgICAgIH0pLmNhdGNoKGZ1bmN0aW9uIChlcnIpIHtcbiAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2coZXJyKTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfSxcbiAgICBnZXRMb2NhbERhdGE6IChkYlByb21pc2UsIG9iamVjdFN0b3JlID0gJ21pc19zdXJ2ZXlzJykgPT4ge1xuICAgICAgICByZXR1cm4gbmV3IFByb21pc2UoZnVuY3Rpb24gKHJlc29sdmUsIHJlamVjdCkge1xuICAgICAgICAgICAgZGJQcm9taXNlLnRoZW4oZnVuY3Rpb24gKGRiKSB7XG4gICAgICAgICAgICAgICAgdmFyIHR4ID0gZGIudHJhbnNhY3Rpb24ob2JqZWN0U3RvcmUsICdyZWFkb25seScpO1xuICAgICAgICAgICAgICAgIHZhciBzdG9yZSA9IHR4Lm9iamVjdFN0b3JlKG9iamVjdFN0b3JlKTtcbiAgICAgICAgICAgICAgICByZXR1cm4gc3RvcmUuZ2V0QWxsKCk7XG4gICAgICAgICAgICB9KS50aGVuKGRhdGEgPT4ge1xuICAgICAgICAgICAgICAgIHJlc29sdmUoZGF0YSk7XG4gICAgICAgICAgICB9KS5jYXRjaChlcnIgPT4ge1xuICAgICAgICAgICAgICAgIHJlamVjdChcIkZhaWxlZCB0byBnZXQgYWxsIGRhdGEuIEVycjogXCIgKyBlcnIpO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pXG4gICAgfSxcbiAgICBhZGRJbmRleGVkRGF0YTogKGRiUHJvbWlzZSwgbmV3RGF0YSwgb2JqZWN0U3RvcmUgPSAnbWlzX3N1cnZleXMnKSA9PiB7XG4gICAgICAgIHJldHVybiBuZXcgUHJvbWlzZShmdW5jdGlvbiAocmVzb2x2ZSwgcmVqZWN0KSB7XG4gICAgICAgICAgICBkYlByb21pc2UudGhlbihmdW5jdGlvbiAoZGIpIHtcbiAgICAgICAgICAgICAgICB2YXIgdHggPSBkYi50cmFuc2FjdGlvbihvYmplY3RTdG9yZSwgJ3JlYWR3cml0ZScpO1xuICAgICAgICAgICAgICAgIHZhciBzdG9yZSA9IHR4Lm9iamVjdFN0b3JlKG9iamVjdFN0b3JlKTtcbiAgICAgICAgICAgICAgICByZXR1cm4gc3RvcmUucHV0KG5ld0RhdGEpLmNhdGNoKChlKSA9PiB7XG4gICAgICAgICAgICAgICAgICAgIHR4LmFib3J0KCk7XG4gICAgICAgICAgICAgICAgICAgIHJlamVjdChlKTtcbiAgICAgICAgICAgICAgICB9KS50aGVuKCgpID0+IHtcbiAgICAgICAgICAgICAgICAgICAgcmVzb2x2ZSgnRGF0YSBhZGRlZCB0byBpbmRleGVkREIgc3VjY2Vzc2Z1bGx5LicpO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuICAgIH0sXG4gICAgZ2V0SXRlbTogKGRiUHJvbWlzZSwga2V5LCBvYmplY3RTdG9yZSA9ICdtaXNfc3VydmV5cycpID0+IHtcbiAgICAgICAgcmV0dXJuIG5ldyBQcm9taXNlKGZ1bmN0aW9uIChyZXNvbHZlLCByZWplY3QpIHtcbiAgICAgICAgICAgIGRiUHJvbWlzZS50aGVuKGZ1bmN0aW9uIChkYikge1xuICAgICAgICAgICAgICAgIHZhciB0eCA9IGRiLnRyYW5zYWN0aW9uKG9iamVjdFN0b3JlLCAncmVhZG9ubHknKTtcbiAgICAgICAgICAgICAgICB2YXIgc3RvcmUgPSB0eC5vYmplY3RTdG9yZShvYmplY3RTdG9yZSk7XG4gICAgICAgICAgICAgICAgcmV0dXJuIHN0b3JlLmdldChrZXkpLmNhdGNoKChlKSA9PiB7XG4gICAgICAgICAgICAgICAgICAgIHR4LmFib3J0KCk7XG4gICAgICAgICAgICAgICAgICAgIHJlamVjdChlKTtcbiAgICAgICAgICAgICAgICB9KS50aGVuKChkYXRhKSA9PiB7XG4gICAgICAgICAgICAgICAgICAgIHJlc29sdmUoZGF0YSk7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfSxcbiAgICAvLyBEZWxldGUgYWxsIGRhdGEgZnJvbSBvYmplY3Qgc3RvcmVcbiAgICB0cnVuY2F0ZU9iamVjdFN0b3JlOiAoZGJQcm9taXNlLCBvYmplY3RTdG9yZSA9ICdtaXNfc3VydmV5cycpID0+IHtcbiAgICAgICAgZGJQcm9taXNlLnRoZW4oZnVuY3Rpb24gKGRiKSB7XG4gICAgICAgICAgICB2YXIgdHggPSBkYi50cmFuc2FjdGlvbihvYmplY3RTdG9yZSwgJ3JlYWR3cml0ZScpO1xuICAgICAgICAgICAgdmFyIHN0b3JlID0gdHgub2JqZWN0U3RvcmUob2JqZWN0U3RvcmUpO1xuICAgICAgICAgICAgcmV0dXJuIHN0b3JlLmNsZWFyKCkuY2F0Y2goKGUpID0+IHtcbiAgICAgICAgICAgICAgICB0eC5hYm9ydCgpO1xuICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKGUpO1xuICAgICAgICAgICAgfSkudGhlbigoKSA9PiB7XG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2coJ0FsbCBEYXRhIGZyb20gT2JqZWN0IHN0b3JlOiAnICsgb2JqZWN0U3RvcmUgKyAnIGhhdmUgYmVlbiB0cnVuY2F0ZWQuJyk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfSxcbiAgICAvLyBBZGQgRGF0YSB0byBJbmRleGVkIERCXG4gICAgYWRkQnVsa0luZGV4ZWREYXRhOiAoZGJQcm9taXNlLCBuZXdEYXRhLCBvYmplY3RTdG9yZSA9ICdtaXNfc3VydmV5cycpID0+IHtcbiAgICAgICAgcmV0dXJuIG5ldyBQcm9taXNlKGZ1bmN0aW9uIChyZXNvbHZlLCByZWplY3QpIHtcbiAgICAgICAgICAgIGRiUHJvbWlzZS50aGVuKGZ1bmN0aW9uIChkYikge1xuICAgICAgICAgICAgICAgIHZhciB0eCA9IGRiLnRyYW5zYWN0aW9uKG9iamVjdFN0b3JlLCAncmVhZHdyaXRlJyk7XG4gICAgICAgICAgICAgICAgdmFyIHN0b3JlID0gdHgub2JqZWN0U3RvcmUob2JqZWN0U3RvcmUpO1xuICAgICAgICAgICAgICAgIHJldHVybiBQcm9taXNlLmFsbChuZXdEYXRhLm1hcChmdW5jdGlvbiAoaXRlbSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgcmV0dXJuIHN0b3JlLnB1dChpdGVtKTtcbiAgICAgICAgICAgICAgICAgICAgfSlcbiAgICAgICAgICAgICAgICApLmNhdGNoKChlKSA9PiB7XG4gICAgICAgICAgICAgICAgICAgIHR4LmFib3J0KCk7XG4gICAgICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKGUpO1xuICAgICAgICAgICAgICAgIH0pLnRoZW4oKCkgPT4ge1xuICAgICAgICAgICAgICAgICAgICBjb25zb2xlLmxvZygnU3luY2VkIHRvIGxvY2FsIHN1Y2Nlc3NmdWxseScpO1xuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuICAgIH0sXG4gICAgc3luY1RvTGl2ZTogKGRiUHJvbWlzZSwgdG9rZW4pID0+IHtcblxuICAgICAgICBmbnMuZ2V0TG9jYWxEYXRhKGRiUHJvbWlzZSkudGhlbigoZGF0YSkgPT4ge1xuICAgICAgICAgICAgZGVsZXRlIGRhdGEuaWQ7IC8vIERvbid0IGluY2x1ZGUgaWQgdXNlZCBieSBpbmRleGVkIGRiXG4gICAgICAgICAgICBmbnMub3B0aW9ucy5ib2R5ID0gSlNPTi5zdHJpbmdpZnkoZGF0YSk7XG4gICAgICAgICAgICBmbnMub3B0aW9ucy5oZWFkZXJzWydYLUNTUkYtVE9LRU4nXSA9IHRva2VuO1xuICAgICAgICAgICAgZmV0Y2goJy9hcGkvc3luYycsIGZucy5vcHRpb25zKVxuICAgICAgICAgICAgICAgIC50aGVuKChyZXNwb25zZSkgPT4ge1xuICAgICAgICAgICAgICAgICAgICAvLyBEZWxldGUgbG9jYWwgZGF0YSBhZnRlciBzdWNjZXNzZnVsIHN5bmNcbiAgICAgICAgICAgICAgICAgICAgZm5zLnRydW5jYXRlT2JqZWN0U3RvcmUoZGJQcm9taXNlKTtcbiAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgIC5jYXRjaCgoZXJyb3IpID0+IHtcbiAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2coZXJyb3IpO1xuICAgICAgICAgICAgICAgIH0pO1xuXG4gICAgICAgIH0pLmNhdGNoKChlcnIpID0+IHtcbiAgICAgICAgICAgIGNvbnNvbGUubG9nKFwiRmFpbGVkIHRvIHN5bmMgXCIgKyBlcnIpO1xuICAgICAgICB9KVxuICAgIH0sXG4gICAgc3luY0Zvcm1zOiAoZGJQcm9taXNlKSA9PiB7XG4gICAgICAgIGZucy5nZXRGb3JtcygpLnRoZW4oKGRhdGEpID0+IHtcbiAgICAgICAgICAgIGZucy5hZGRCdWxrSW5kZXhlZERhdGEoZGJQcm9taXNlLCBkYXRhLCAnbWlzX2Zvcm1zJyk7XG5cbiAgICAgICAgICAgIGZucy5nZXRJdGVtKGRiUHJvbWlzZSwgJ3Rlc3QtZm9ybScsICdtaXNfZm9ybXMnKS50aGVuKGZ1bmN0aW9uIChkYXRhKSB7XG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2coZGF0YSk7XG4gICAgICAgICAgICB9KS5jYXRjaChmdW5jdGlvbiAoZXJyKSB7XG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2coZXJyKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9KVxuICAgIH0sXG4gICAgZ2V0Rm9ybXM6ICgpID0+IHtcbiAgICAgICAgcmV0dXJuIG5ldyBQcm9taXNlKGZ1bmN0aW9uIChyZXNvbHZlLCByZWplY3QpIHtcbiAgICAgICAgICAgIGZldGNoKCcvYWRtaW4vdXNlci9nZXRBbGxGb3JtcycpLnRoZW4oKGRhdGEpID0+IHtcbiAgICAgICAgICAgICAgICByZXR1cm4gZGF0YS5qc29uKCk7XG4gICAgICAgICAgICB9KS50aGVuKChqc29uU3RyaW5nKSA9PiB7XG4gICAgICAgICAgICAgICAgcmVzb2x2ZShqc29uU3RyaW5nKTtcbiAgICAgICAgICAgIH0pXG4gICAgICAgIH0pXG5cbiAgICB9XG5cbn07XG4iXX0=
},{}]},{},[1])