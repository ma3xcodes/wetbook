<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Seleccionar idioma</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                @foreach($languages as $key => $lang)
                    <div class="col-xs-3">
                        <a href="#" class="btn select-language btn-link btn-block btn- @if(!$lang->is_enable) disabled text-muted @endif" @if($lang->is_enable) data-lang="{{\Hashids::encode($lang->id)}}" @endif>
                            {{$lang->language}}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <!--<div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>-->
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->