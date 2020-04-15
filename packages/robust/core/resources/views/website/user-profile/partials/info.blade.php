<h3 class="title-more-detail" id="my-info">My info</h3>
<div>
   <div class="col-md-6">
      <div class="profile-inner">
         <h3 class="title-detail info-form"> Personal info</h3>
         <form action="{{route('website.realestate.leads.update',['id'=>$lead->id])}}" method="POST">
             @csrf
            <div class="form-group col s12">
               <label for="txtuser" class=" control-label">Firstname</label>
               <input type="text" class="form-control" placeholder="firstname"
                     name="firstname" value="{{$lead->first_name ?? ''}}">
            </div>
            <div class="form-group col s12">
               <label for="txtuser" class="control-label">Lastname</label>
                <input type="text" class="form-control" placeholder="lastname"
                     name="lastname" value="{{$lead->last_name}}">
            </div>
            <div class="form-group col s12">
               <label for="inputEmail" class="control-label">Phone</label>
               <input type="text" class="form-control" name="phone_number"
                     placeholder=""
                     value="{{$lead->phone_number ?? ''}}">
            </div>
            <div class="form-group col s12">
               <label></label>
               <div>
                  <button type="submit" class="btn btn-xs btn-theme">Save</button>
               </div>
            </div>
         </form>
      </div>
   </div>
   <div class="col-md-6">
      <div class="profile-inner">
         <h3 class="title-detail info-form">Change password</h3>
          @foreach($errors->all() as $error)
              <div class="alert-danger">{{$error}}</div>
          @endforeach
         <form class="form-horizontal" action="{{route('website.realestate.leads.update.password',['id'=>$lead->id])}}" method="POST">
            @csrf
             <div class="form-group col s12">
               <label for="inputPassword" class="control-label">Old Password</label>
               <input type="password" class="form-control" name="old_password" placeholder="" value="">
            </div>
            <div class="form-group col s12">
               <label for="inputPassword2" class="col-sm-3 control-label">New Password</label>
               <input type="password" class="form-control" name="password" placeholder="">
            </div>
            <div class="form-group col s12">
               <label for="inputPassword3" class="col-sm-3 control-label">Confirm New Password</label>
               <input type="password" class="form-control" name="password_confirmation" placeholder="">
            </div>
            <div class="form-group col s12">
               <label></label>
               <div>
                  <button type="submit" class="btn btn-xs btn-theme">Save Password</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
