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
            <form class="form-horizontal" action="{{url('/save-product')}} " method="POST" enctype="multipart/form-data">
                @csrf
                
              <fieldset>
               
                <div class="control-group">
                  <label class="control-label" for="date01" >Product Name</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" name="product_name" required="" >
                  </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="selectError3">Product Category</label>
                    <div class="controls">
                      <select id="selectError3" name="category_id">
                        
                        <?php 
                        $all_published_category=DB::table('tbl_category')
                        ->where('publication_status',1)
                        ->get(); 
                        ?>
                          @foreach ($all_published_category as $row) 
                      <option value="{{$row->category_id}}">{{$row->category_name}}</option>
                        @endforeach
                        
                      </select>
                    
                    </div>
                  </div>
                     
                  <div class="control-group">
                    <label class="control-label" for="selectError3" >Manufacture Name</label>
                    <div class="controls">
                      <select id="selectError3" name="manufacture_id">
                        
                        <?php 
								      	$all_published_manufacture=DB::table('manufacture')
								     	->where('manufacture_status',1)
								     	->get();
								       	?> 
		
		                       @foreach ($all_published_manufacture as $row)
                        <option value="{{$row->manufacture_id}}">{{$row->manufacture_name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>


                     
                <div class="control-group hidden-phone">
                  <label class="control-label" for="textarea2">Product Short Description</label>
                  <div class="controls">
                    <textarea class="cleditor" name="product_short_description" rows="3" required="" ></textarea>
                  </div>
                </div>

                <div class="control-group hidden-phone">
                    <label class="control-label" for="textarea2">Product Long Description</label>
                    <div class="controls">
                      <textarea class="cleditor" name="product_long_description" rows="3" required="" ></textarea>
                    </div>
                  </div>
              
                  <div class="control-group">
                    <label class="control-label" for="date01" >Product price</label>
                    <div class="controls">
                      <input type="text" class="input-xlarge" name="product_price" required="" >
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Image</label>
                    <div class="controls">
                      <input type="file" name="product_image">
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="date01" >Product Size</label>
                    <div class="controls">
                      <input type="text" class="input-xlarge" name="product_size" required="" >
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="date01" >Product Color</label>
                    <div class="controls">
                      <input type="text" class="input-xlarge" name="product_color" required="" >
                    </div>
                  </div>
       
                <div class="control-group hidden-phone">
                    <label class="control-label" for="textarea2">Publication Status</label>
                    <div class="controls">
                     <input type="checkbox" name="publication_status" value="1">
                    </div>
                  </div>

                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Add Product</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->



@endsection