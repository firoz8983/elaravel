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
                      <th>Manufacture ID</th>
                      <th>Manufacture Name</th>
                      <th>Manufacture Description</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              
            
                  
             
              <tbody>
               @foreach ($all_manufacture_info as $row)
                <tr>
                    <td>{{$row->manufacture_id}} </td>
                <td class="center">{{ $row->manufacture_name}}</td>
                <td class="center">{{$row->manufacture_description}} </td>


                    
                 <td class="center">
                    @if($row->manufacture_status==1)
                        <span class="label label-success">Active</span>
                    @else 
                    <span class="label label-danger"> Inactive  </span>
                    @endif
                  </td>

                    <td class="center">
                        @if($row->manufacture_status==1)
                        <a class="btn btn-danger" href="{{URL::to('/inactive-manufacture/'.$row->manufacture_id)}} ">
                            <i class="halflings-icon white thumbs-down"></i>  
                        </a>
                        @else
                        <a class="btn btn-success" href="{{URL::to('/active-manufacture/'.$row->manufacture_id)}}">
                            <i class="halflings-icon white thumbs-up"></i>  
                        </a>
                        @endif

                        <a class="btn btn-info" href="{{URL::to('/edit-manufacture/'.$row->manufacture_id)}}">
                            <i class="halflings-icon white edit"></i>  
                        </a>
                        <a class="btn btn-danger" href="{{URL::to('/delete-manufacture/'.$row->manufacture_id)}}">
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