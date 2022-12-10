<div class="modal fade ui-front" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px ui-front">
        <div class="modal-content ui-front">
            <form class="form" action="{{ route('models_jmol.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($errors->count()!=0)
                <span class="text-danger">{{ $errors }}</span>
                @endif
                <div class="modal-body">
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <label class="form-label mt-2">Model Name</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="text" name="model_name" class="form-control" id="model_name">
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="form-label mt-2">File Name</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="text" name="file_name" class="form-control" id="file_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <label class="form-label mt-2">Mov File Name</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="text" name="mov_filename" class="form-control" id="mov_filename">
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="form-label mt-2">Model Topic</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="text" name="model_topic" class="form-control" id="model_topic" required>
                                </div>
                            </div>
                        </div>
                        <div class="fv-row">
                            <label class="form-label mt-2">Model Description</label>
                            <textarea class="form-control form-control-solid" data-kt-autosize="true" name="model_description" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <label class="form-label mt-2">Model Tag</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="text" name="model_tag1" class="form-control" id="model_tag1" required>
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="form-label mt-2">model tag additionnel</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="text" name="model_tag2" class="form-control" id="model_tag2" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <label class="form-label mt-2">Upload an image</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="file" class="form-control" name="file_Img" required>
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="form-label mt-2">model Intro</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="text" name="model_intro" class="form-control" id="model_intro" required>
                                </div>
                            </div>
                        </div>
                        <div style="margin-left: 35%;">
                            <div class="col-md-6 fv-row">
                                <label class="form-label mt-2">Model Level</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="text" name="model_level" class="form-control" id="model_level" required>
                                </div>
                            </div>
                        </div>
                        <div class="fv-row">
                            <label class="form-label mt-2">Extra</label>
                            <textarea class="form-control form-control-solid" data-kt-autosize="true" name="ext" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="reset" style="background-color: #DAA520; color: white;" class="btn me-3">Discard</button>
                    <button type="submit" style="background-color: #00308F; color: white;" class="btn">
                        <span class="indicator-label">Submit</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
