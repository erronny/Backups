<div class="col-sm-10" id="list">
              <div class="top_section">
                <div class="row form-group">
                  <div class="col-sm-4">
                  <span class="col-sm-6">Start Date</span>
                  <span class="col-sm-6">{{date('d M Y',strtotime($content->created_at))}}</span>
                  </div>

                  <div class="col-sm-4">
                  <span class="col-sm-6">Due Date</span>
                  <span class="col-sm-6">{{date('d M Y',strtotime($content->created_at))}}</span>
                  </div>

                  <div class="col-sm-4">
                  <span class="col-sm-6">Status</span>
                  <span class="col-sm-6">{{$content->status}}</span>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-4">
                  <span class="col-sm-6">Priority</span>
                  <span class="col-sm-6">High</span>
                  </div>

                  <div class="col-sm-4">
                  <span class="col-sm-6">Assigned To</span>
                  <span class="col-sm-6">{{$content->user_detail->name}}</span>
                  </div>

                  <div class="col-sm-4">
                  <span class="col-sm-6">Owner</span>
                  <span class="col-sm-6">{{$content->addedBy->studio_detail->studio_name}}</span>
                  </div>
                </div>
                
              </div>
              <div class="pt-4 middle_section">
                <div class="content_section">
                  <div class="row form-group">
                    <div class="col-sm-5">
                      <textarea placeholder="Original content" class="form-control"></textarea>
                    </div>
                    <div class="col-sm-5">
                      <textarea placeholder="Translate content" class="form-control"></textarea>
                    </div>
                    <div class="col-sm-2">
                      <button class="btn btn-warning">Translate</button>
                    </div>
                  </div>

                  <div class="row form-group">
                    <div class="col-sm-5">
                      <textarea placeholder="Original content" class="form-control"></textarea>
                    </div>
                    <div class="col-sm-5">
                      <textarea placeholder="Translate content" class="form-control"></textarea>
                    </div>
                    <div class="col-sm-2">
                      <button class="btn btn-warning">Translate</button>
                    </div>
                  </div>


                  <div class="row form-group">
                    <div class="col-sm-5">
                      <textarea placeholder="Original content" class="form-control"></textarea>
                    </div>
                    <div class="col-sm-5">
                      <textarea placeholder="Translate content" class="form-control"></textarea>
                    </div>
                    <div class="col-sm-2">
                      <button class="btn btn-warning">Translate</button>
                    </div>
                  </div>

                </div>

              </div>
              <div class="pt-4 bottom_section">
                  

                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                  <a class="nav-link active" href="#comment" role="tab" data-toggle="tab">Comments</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="#notes_section" role="tab" data-toggle="tab">Notes</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="#dependancy_section" role="tab" data-toggle="tab">Dependancy</a>
                  </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active show" id="comment">
                  <div class="form-group" id="comment_section">
                    @foreach($comments as $k=>$comment)
                    <div class="comment">
                      <div>{{$comment->comment}}</div>
                      <div class="text text-right">{{$comment->created_at}}</div>
                    </div>
                    @endforeach
                  </div>
                  <div class="form-group">
                    <textarea placeholder="Enter Comment" name="comments" id="comments" class="form-control comment_text"></textarea>
                  </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="notes_section">
                    <div id="notes_section_data">
                      <div class="comment">
                        <div>{{$content->notes}}</div>
                        <div class="text text-right">{{$content->created_at}}</div>
                      </div>
                      
                    </div>
                    @if($content->notes =='')
                      <span onclick="notesShow();" style="cursor:pointer;">New</span>
                      @else
                      <span onclick="notesShow();" style="cursor:pointer;">Edit</span>
                      @endif
                    <div class="form-group" id="notes_section_value" style="display: none;">
                      <textarea placeholder="Enter Notes" name="notes" id="notes" class="form-control" >{{$content->notes}}</textarea>
                      <button class="btn btn-info" onclick="save_data('notes')">Save</button>
                      <span id="error_notes"></span>
                    </div>
                    

                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="dependancy_section">
                    <div id="dependancy_section_data">
                      <div class="comment">
                        <div>{{$content->dependancy}}</div>
                        <div class="text text-right">{{$content->created_at}}</div>
                      </div>
                     
                    </div>
                    @if($content->dependancy =='')
                    <span onclick="dependancyShow();" style="cursor: pointer;">New</span>
                    @else
                    <span onclick="dependancyShow();" style="cursor: pointer;">Edit</span>
                    @endif
                    <div class="form-group" id="dependancy_section_value" style="display: none;">
                      <textarea placeholder="Enter Dependancy" name="dependancy" id="dependancy" class="form-control">{{$content->dependancy}}</textarea>
                     <button class="btn btn-info" onclick="save_data('dependancy')">Save</button>
                      <span id="error_dependancy"></span>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>


  <div class="col-sm-12 text text-right">
  <input type="hidden" name="content_id" id="content_id" value="{{$content->id}}">
  <button type="" class="btn btn-info ">Publish</button>
  </div>            