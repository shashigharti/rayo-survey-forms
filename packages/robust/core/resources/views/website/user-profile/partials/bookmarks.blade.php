<div class="row">
    <div class="col-md-12">
        <h3 class="title-more-detail" id="my-saved-bookmarks">My Saved Bookmarks ({{$lead->bookmarks ? $lead->bookmarks->count(): 0}})</h3>
        <table class="table table-striped table-saved-alerts">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Url</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @if(isset($lead->bookmarks) && !empty($lead->bookmarks))
                    @foreach($lead->bookmarks as $bookmark)
                        <tr>
                            <td>{{$bookmark->id}}</td>
                            <td>{{$bookmark->title}}</td>
                            <td><a href="{{$bookmark->url}}">Visit</a></td>
                            <td><a href="{{route('website.realestate.leads.bookmarks.delete',['id'=>$bookmark->id])}}">Remove</a></td>
                            <td></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
