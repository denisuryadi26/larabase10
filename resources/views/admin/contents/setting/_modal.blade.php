<!-- Modal -->
<div class="modal fade text-left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Basic Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" id="formModal"
                      novalidate>
                    @csrf
                    <input type="hidden" name="id" id="id" class="id">
                    <fieldset class="form-group floating-label-form-group">
                        <label for="user-name">Parameter</label>
                        <div class="controls">
                            <input type="text" class="form-control" id="parameter" name="parameter"
                                   placeholder="Parameter"
                                   data-validation-required-message="This field is required">
                        </div>
                    </fieldset>

                    <fieldset class="form-group floating-label-form-group">
                        <label for="group">Type</label>
                        <div class="controls">
                            <select class="select2 form-control form-control-lg" id="type" name="type">
                                <option value="text">Text</option>
                                <option value="upload">Upload</option>
                                <option value="editor">Editor</option>

                            </select>
                        </div>
                    </fieldset>

                    <fieldset class="form-group floating-label-form-group">
                        <label for="user-name">Value</label>
                        <div class="controls">
                            {{--                            <input type="text" class="form-control" id="value" name="value"--}}
                            {{--                                   placeholder="Value"--}}
                            {{--                                   data-validation-required-message="This field is required">--}}
                        </div>
                        <textarea class="form-control" id="value" name="value"></textarea>
                        <input type="file" class="files hidden" id="fileUpload">
                    </fieldset>

                    <div class="modal-footer">
                        <button id="save" type="submit" class="btn btn-outline-info save">Save changes</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

