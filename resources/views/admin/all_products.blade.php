@extends('admin_layout')
@section('admin_content')
 <p class="alert-success">
    <?php
     $message=Session::get('message'); 
   if($message){
       echo $message;
       Session::put('message',null);
     }
    ?>
  </p>
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Table</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                  <tr>
                      <th>Product ID</th>
                      <th>Product Name</th>
                    
                      <th>product image</th>
                      <th>product price</th>
                      <th>category name</th>
                      <th>manufacture name</th>
                  </tr>
              </thead>
              
            
              
             
              <tbody>
                @foreach ($all_products as $row)
                <tr>
                   
                    <td>{{$row->product_id}} </td>
                <td class="center">{{ $row->product_name}}</td>
                
                <td> <img src="{{URL::to($row->product_image)}}" style="height: 40px; width: 40px;"> </td>
                <td class="center">{{ $row->product_price}} Tk</td>
                <td class="center">{{ $row->category_name}}</td>
                <td class="center">{{ $row->manufacture_name}}</td>
               

                    
                 <td class="center">
                    @if($row->publication_status==1)
                        <span class="label label-success">Active</span>
                    @else 
                    <span class="label label-danger"> Inactive  </span>
                    @endif
                  </td>

                    <td class="center">
                        @if($row->publication_status==1)
                        <a class="btn btn-danger" href="{{URL::to('/inactive_product/'.$row->product_id)}} ">
                            <i class="halflings-icon white thumbs-down"></i>  
                        </a>
                        @else
                        <a class="btn btn-success" href="{{URL::to('/active_product/'.$row->product_id)}}">
                            <i class="halflings-icon white thumbs-up"></i>  
                        </a>
                        @endif

                        <a class="btn btn-info" href="{{URL::to('/edit-product/'.$row->product_id)}}">
                            <i class="halflings-icon white edit"></i>  
                        </a>
                        <a class="btn btn-danger" href="{{URL::to('/delete-product/'.$row->product_id)}}">
                            <i class="halflings-icon white trash"></i> 
                        </a>
                    </td>
                   
                </tr>
                
                @endforeach
              </tbody>
           
          </table>            
        </div>
    </div><!--/span-->

</div><!--/row-->


    
@endsection