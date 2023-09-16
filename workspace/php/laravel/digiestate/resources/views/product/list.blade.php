<div class="tab-section active" id="grid">
    <div class="panel-group" id="accordion">
        @foreach($documents as $key=>$document)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row" >
                        <div class="col-sm-6 panel-tab" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" tab-id="collapse{{$key}}">
                            <h4 class="panel-title">
                                @if($document->IsActive)
                                <span class="text text-success fa fa-check"></span>
                                @else
                                <span class="text text-danger fa fa-remove"></span>
                                @endif
                                <a onclick="toggleTitle()">{{$document->name}}</a>
                            </h4>
                        </div>
                        <div class="col-sm-6 text text-right">
                            @if(Auth::user()->user_type == 0)
                            {{$document->user_name->name.' / '}}
                            @endif
                           ( <span>Date:{{date('d M Y',strtotime($document->created_at))}}</span> )                                                       
                            <?php if(!$document->bookMark){ ?>
                            <a href="{{ URL::to('admin/updateDocument/'.$document->id.'/add-bookmark') }}" class="btn text text-info" style="margin-right: 3px;" data-toggle="tooltip" title="add bookmark"><i class="fa fa-bookmark-o"></i></a>
                            <?php }else{ ?>
                            <a href="{{ URL::to('admin/updateDocument/'.$document->id.'/remove-bookmark') }}" class="btn text text-warning" style="margin-right: 3px;" data-toggle="tooltip" title="remove bookmark"><i class="fa fa-bookmark"></i></a>
                            <?php } ?>
                            <a href="{{ URL::to('admin/document/'.$document->id.'/edit') }}" class="btn btn-info" style="margin-right: 3px;" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                                        
                            <?php if($document->IsActive){ ?>
                            <a href="{{ URL::to('admin/updateDocument/'.$document->id.'/deactive') }}" class="btn btn-warning" style="margin-right: 3px;" onclick="return confirm('Are You Sure To Dctivated?')" title="Click to Deactive"><i class="fa fa-eye-slash"></i></a>
                            <?php }else{ ?>
                            <a href="{{ URL::to('admin/updateDocument/'.$document->id.'/active') }}" class="btn btn-success" style="margin-right: 3px;" onclick="return confirm('Are You Sure To Activated?')" title="Click to Active"><i class="fa fa-eye"></i></a>
                            <?php } ?>
                               
                            {{ Form::open(['id' => 'delete','method' => 'DELETE', 'route' => ['document.destroy', $document->id] ]) }}

                            <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Do You want to Delete?')">
                            <i class="fa fa-trash"></i></button>
                            {{ Form::close() }}                                         
                        </div>
                    </div>
                </div>

                <div id="collapse{{$key}}" class="panel-collapse collapse <?php if($key ==0){echo "in"; } ?>">
                  <div class="panel-body">
                    <div class="row">
                        @if(Auth::user()->user_type == 1)
                            @if(count($document->image) && !empty($document->image))
                            <div class="col-sm-12">
                                <input type="checkbox" class="item-select" did="<?=  $document->id; ?>" name="">All
                                <button class="btn btn-danger deleteDocument" target="_blank" title="Click to Delete" onclick="onClickDeleteItem()"><i class="fa fa-trash"></i></button>
                                <button class="btn btn-warning shareDocument" target="_blank" title="Click to Delete"><i class="fa fa-share"></i></button>
                            </div>
                            @endif
                        @endif
                        @foreach($document->image as $key=>$list)
                        @php 
                            $arr = explode('.', $list->url);   
                            $ext = $arr[1];
                        @endphp
                        <!-- <div>Title</div> -->
                        
                        <div class="col-sm-3 form-group">
                            @if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG')
                                
                                <img class="document-size" src="{{asset('assets/img/documents/'.$list->url)}}">
                            
                            @elseif ($ext == 'pdf') 
                                <embed class="document-size" src="{{asset('assets/img/documents/'.$list->url)}}" type="application/pdf" />

                            {{-- @else --}}
                            @elseif ($ext == 'doc' || $ext == 'docx') 
                                <div class="document-size">
                                    <a class="btn btn-primary" href="{{URL('assets/img/documents/'.$list->url)}}" target="_blank"><img src="{{URL('assets/doc.png')}}"></a>
                                    
                                </div>
                            @elseif ($ext == 'xls' || $ext == 'xlsx' || $ext == 'csv') 
                                <div class="document-size">
                                    <a class="btn btn-primary" href="{{URL('assets/img/documents/'.$list->url)}}" target="_blank"><img src="{{URL('assets/excel.png')}}"></a>
                                </div>
                            @else 
                                <div class="alert alert-danger">No Recods</div>
                            @endif
                            <div class="text text-center"><?= $list->doc_name; ?></div>
                            <!-- <div>Edit</div> -->

                            <div style="text-align: center;" >
                               @if(Auth::user()->user_type == 1)
                                <input type="checkbox" value="{{$list->id}}" class="all-document <?=  'item'.$document->id; ?>" name="">
                                @endif
                            @if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG' || $ext == 'pdf')

                            
                            <a class="btn btn-primary" href="{{URL('assets/img/documents/'.$list->url)}}" target="_blank">View</a>

                            <a class="btn btn-info" href="{{URL::to('admin/qrcode/'.$list->id.'/create')}}">Generate QrCode</a>

                            

                            @elseif($ext == 'doc' || $ext == 'docx' || $ext == 'xls' || $ext == 'xlsx' || $ext== 'csv')
                            <a class="btn btn-primary" href="{{URL('assets/img/documents/'.$list->url)}}" target="_blank">Download</a>
                            
                            @endif

                            {{-- <a class="btn btn-danger" href="{{URL('assets/img/documents/'.$list->url)}}" target="_blank" title="Click to Delete"><i class="fa fa-trash"></i></a> --}}
                            {{-- <a class="btn btn-warning" href="{{URL('assets/img/documents/'.$list->url)}}" target="_blank" title="Deactive"><i class="fa fa-eye-slash" ></i></a> --}}
                            {{-- <a class="btn btn-warning" href="{{URL('assets/img/documents/'.$list->url)}}" target="_blank" title="Active"><i class="fa fa-eye"></i></a> --}}
                            
                            </div>           
                            </div>
                            
                            
                        @endforeach

                
                    </div>
                      
                    
                  </div>
                </div>
            </div>
        @endforeach
    </div>                            
</div>