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
                      <th>Slider ID</th>
                  
                      <th>Slider image</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
              
            
              
             
              <tbody>
                @foreach ($all_slider as $row)
                <tr>
                   
                    <td>{{$row->slider_id}} </td>
                
                <td> <img src="{{URL::to($row->slider_image)}}" style="height: 40px; width: 40px;"> </td>
            
               

                    
                 <td class="center">
                    @if($row->publication_status==1)
                        <span class="label label-success">Active</span>
                    @else 
                    <span class="label label-danger"> Inactive  </span>
                    @endif
                  </td>

                    <td class="center">
                        @if($row->publication_status==1)
                        <a class="btn btn-danger" href="{{URL::to('/inactive_slider/'.$row->slider_id)}} ">
                            <i class="halflings-icon white thumbs-down"></i>  
                        </a>
                        @else
                        <a class="btn btn-success" href="{{URL::to('/active_slider/'.$row->slider_id)}}">
                            <i class="halflings-icon white thumbs-up"></i>  
                        </a>
                        @endif

                       
                        <a class="btn btn-danger" href="{{URL::to('/delete-slider/'.$row->slider_id)}}">
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