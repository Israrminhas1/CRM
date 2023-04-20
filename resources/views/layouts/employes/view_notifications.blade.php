@extends('layout.master')


@section('title', 'Notifications')

@section('content')

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">

                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN PAGE BAR -->


                        <!-- END PAGE BAR -->

                        <!-- BEGIN PAGE TITLE-->

                        <h3 class="page-title mt-3"> Notifications <a class="btn btn-success " href="{{url('mark-all-read')}}" class="btn btn-info">Mark All As Read</a>


                        </h3>

                        <!-- END PAGE TITLE-->

                        <!-- END PAGE HEADER-->

                        <!-- BEGIN DASHBOARD STATS 1-->

                        @if(Session::has('errorMsg'))
                        <div class="alert alert-danger">{{Session::get('errorMsg')}}</div>
                        @endif
                        @if(Session::has('successMsg'))
                        <div class="alert alert-success">{{Session::get('successMsg')}}</div>
                        @endif
                      
                                <ul class="todo_list list-unstyled" style="line-height: 0;">
                                    @foreach ( Auth::user()->notifications as $notification)
                                    @if ($notification->read_at == null)

                                  <li  style=" background-color:#E1E5EC ; ">
                                    @else
                                    <li>

                                    @endif
                                  
                                        <label class="fancy-checkbox" >
                                            <div class="d-flex justify-content-between" >
                                            @if ($notification->read_at == null)
                                            <a  href="{{url('mark-single-read/'.$notification->id)}}" class="btn " style="font-size: 10px"  title="Mark As read"> <i class="fa  fa-circle"></i> </a>
                                            @else
                                            <a href="{{url('mark-single-unread/'.$notification->id)}}" class="btn   " style="color: green; font-size: 10px " title="Mark As read"> <i style="font-size: 12px"  class="fa  fa-check"></i> </a>
                                            @endif
                                            @if ($notification->took_action == null)
                                            <a href="{{url('mark-action/'.$notification->id)}}" style="font-size: 10px" class="btn   yellow btn-outline" title="Took Action"> <i class="fa fa-reply"></i> </a>
                                            @else
                                            <button class="btn dark btn-outline " style="font-size: 10px" title="Action Performed" disabled> <i class="fa fa-share"></i> </button>
                                            @endif
                                            <small class="font-12 text-muted ml-auto mt-2 "><i>Posted on</i> {{$notification->created_at}}</small>
                                        </div>
                                            <span >
                                                <div class="d-flex justify-content-between mb-0 ">
                                                    <span  class="font-18  mr-auto pt-2 pl-2 pr-2 pb-1">{{$notification->data['letter']['title']}}</span>
                                                    
                                                    <a href="#" class="text-danger pt-2 pl-2 pr-2 pb-1"><i class="fa fa-bell"></i></a>
                                                </div>
                                                
                                                <p class="mb-0 p-2">{{$notification->data['letter']['body']}}</p>
                                            </span>
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>   
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                {{-- @foreach ( Auth::user()->notifications as $notification)
                                        @if ($notification->read_at == null)

                                        <div class="media mt-2 " style="border-bottom:1px solid #36c6d3 ; background-color:#E1E5EC ; padding:10px ">
                                        @else
                                        <div class="media mt-2" style="border-bottom:1px solid #36c6d3; padding:10px">

                                        @endif
                                            <i class="fa fa-bell"></i>
                                            @if ($notification->read_at == null)
                                            <a href="{{url('mark-single-read/'.$notification->id)}}" class="btn green btn-outline" title="Mark As read"> <i class="fa fa-check"></i> </a>
                                            @else
                                            <a href="{{url('mark-single-unread/'.$notification->id)}}" class="btn dark btn-outline" title="Mark As read"> <i class="fa fa-circle"></i> </a>
                                            @endif
                                            @if ($notification->took_action == null)
                                            <a href="{{url('mark-action/'.$notification->id)}}" class="btn yellow btn-outline" title="Took Action"> <i class="fa fa-reply"></i> </a>
                                            @else
                                            <button class="btn dark btn-outline" title="Action Performed" disabled> <i class="fa fa-share"></i> </button>
                                            @endif
                                        <div class="media-body">
                                            <h4>{{$notification->data['letter']['title']}} <small><i>Posted on {{$notification->created_at}}</i></small></h4>
                                            <p>{{$notification->data['letter']['body']}}</p>
                                        </div>
                                        </div>

                                @endforeach --}}
                                <!-- END EXAMPLE TABLE PORTLET-->
                       



                        <div class="clearfix"></div>

                        <!-- END DASHBOARD STATS 1-->

@endsection
