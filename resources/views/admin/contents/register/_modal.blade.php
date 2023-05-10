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
                <form class="form-horizontal" method="POST" id="formModal" novalidate>
                    @csrf
                    <input type="hidden" name="id" id="id" class="id">
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group floating-label-form-group">
                                <label for="user-name">Full Name</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name" required data-validation-required-message="This field is required">
                                </div>
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="nik">NIK</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" required data-validation-required-message="This field is required">
                                </div>
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required data-validation-required-message="This field is required">
                                </div>
                            </fieldset>

                            <!-- <fieldset class="form-group floating-label-form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <div class="controls">
                                    <input class="form-control" id="tgl_lahir" required>
                                </div>
                            </fieldset> -->

                            <fieldset class="form-group floating-label-form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <div class="controls">
                                    <!-- <input type="date" class="form-control" name="tgl_lahir" required> -->
                                    <input class="form-control" id="tgl_lahir" required>
                                    <!-- <input type="text" id="pd-months-year" class="form-control pickadate-months-year" name="tgl_lahir" required /> -->
                                    <!-- <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control pickadate-months-year" placeholder="18 June, 2020" /> -->
                                </div>

                                <!-- <div class="col-12 col-md-6 form-group">
                                    <label for="pd-months-year">Select Month & Year</label>
                                    <input type="text" id="pd-months-year" class="form-control pickadate-months-year" placeholder="18 June, 2020" />
                                </div> -->
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="alamat">Alamat Lengkap</label>
                                <div class="controls">
                                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat Lengkap" required data-validation-required-message="This field is required"></textarea>
                                </div>
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="no_hp">No. Hp</label>
                                <div class="controls">
                                    <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor HP" required data-validation-required-message="This field is required">
                                </div>
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="user-name">Your Email</label>
                                <div class="controls">
                                    <input type="email" name="email" id="email" class="form-control" required data-validation-required-message="This field is required" placeholder="Your Email">
                                </div>
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="group">Group</label>
                                <div class="controls">

                                    <select class="select2 form-control form-control-lg" id="group" name="group_id" style="padding:10px !important;">
                                        @foreach($group as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group floating-label-form-group">
                                <label for="agama">Agama</label>
                                <div class="controls">

                                    <select class="select2 form-control form-control-lg" id="agama" name="agama_id" style="padding:10px !important;">
                                        @foreach($agama as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="kategori">Kategori</label>
                                <div class="controls">

                                    <select class="select2 form-control form-control-lg" id="kategori" name="kategori_id" style="padding:10px !important;">
                                        @foreach($kategori as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="sabuk">Sabuk</label>
                                <div class="controls">

                                    <select class="select2 form-control form-control-lg" id="sabuk" name="sabuk_id" style="padding:10px !important;">
                                        @foreach($sabuk as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="unlat">Unlat</label>
                                <div class="controls">

                                    <select class="select2 form-control form-control-lg" id="unlat" name="unlat_id" style="padding:10px !important;">
                                        @foreach($unlat as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="user-name">User Name</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="User Name" required data-validation-required-message="This field is required">
                                </div>
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="status">Status</label>
                                <div class="controls">

                                    <!-- <select class="select2 form-control form-control-lg" id="status" name="status" style="padding:10px !important;">
                                        <option value="" disabled selected>SELECT STATUS</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                        @foreach($status as $item)
                                        <option value="{{$item}}" {{ $item == $status ? 'selected' : '' }}>{{$item}}</option>
                                        @endforeach
                                    </select> -->
                                    <select class="select2 form-control form-control-lg" id="status" name="status" style="padding:10px !important;">
                                        <option value="" disabled selected>SELECT STATUS</option>
                                        @foreach($status as $label => $value)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group mb-1">
                                <label for="user-password">Enter Password</label>
                                <div class="controls">
                                    <input type="password" name="password" id="password" class="form-control" required data-validation-required-message="This field is required" placeholder="Enter Password">
                                </div>
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group mb-1">
                                <label for="user-password">Confirm Password</label>
                                <div class="controls">
                                    <input type="password" data-validation-match-match="password" class="form-control mb-1" placeholder="Re type password" required>
                                </div>
                            </fieldset>
                        </div>
                    </div>



                    <div class="modal-footer">
                        <button id="formSubmit" type="submit" class="btn btn-outline-info">Save changes</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>