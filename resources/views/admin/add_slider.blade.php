@extends('admin_layout')
@section('admin_content')
	
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Add product</a>
        <i class="icon-angle-right"></i> 
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Add Product</a>
    </li>
</ul>
<div class="row-fluid sortable">
    <div class="box span12">
        <p class="alert-success" >
          <?php
        $message=Session::get('message');
        if($message){
          echo $message;
          Session::put('message',null);
        }
       
       
        ?>
        </p>
        <div class="box-content">
            <form class="form-horizontal" action="{{url('/save-slider')}} " method="POST" enctype="multipart/form-data">
                @csrf
                
              <fieldset>
               
                  <div class="control-group">
                    <label class="control-label">Slider Image</label>
                    <div class="controls">
                      <input type="file" name="slider_image">
                    </div>
                  </div>

                <div class="control-group hidden-phone">
                    <label class="control-label" for="textarea2">Publication Status</label>
                    <div class="controls">
                     <input type="checkbox" name="publication_status" value="1">
                    </div>
                  </div>

                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Add Slider</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->



@endsection