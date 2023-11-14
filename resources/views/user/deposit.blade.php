<x-app-layout>

    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">


            <!-- row -->
            <div class="row">

            </div>
            <div class="row">

                <div class="col-xl-12">
                    <div class="card h-auto">
                        <div class="card-body">
                            <div class="profile-tab">
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a href="#my-posts" data-bs-toggle="tab" class="nav-link active show">Fund
                                                Your Account Balance</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content">
                                        <div id="my-posts" class="tab-pane fade active show">
                                            <div class="pt-3">
                                                <div class="settings-form">
                                                    <h4 class="text-primary">Deposit Method</h4>
                                                    <form method="POST" action="{{ route('user.deposits') }}"
                                                        enctype="multipart/form-data">@csrf
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Enter Amount</label>
                                                                <input type="text " placeholder="Amount"
                                                                    class="form-control" name="amount" required />
                                                                <x-input-error :messages="$errors->get('amount')" class="mt-2 " />

                                                            </div>


                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="formFileSm" class="form-label">Upload Proof
                                                                After Payment </label>
                                                            <input class="form-control form-control-sm" id="formFileSm"
                                                                type="file" name="image" />
                                                            <x-input-error :messages="$errors->get('image')" class="mt-2" />

                                                        </div>


                                                        <div class="row">
                                                            @foreach ($payments as $payment)
                                                                <div class="mb-3 col-md-2">
                                                                    <label class="form-label">Name</label>
                                                                    <input type="text" class="form-control" readonly
                                                                        value="{{ $payment->name }}" />
                                                                </div>

                                                                <div class="mb-3 col-md-2">
                                                                    <label class="form-label">Network</label>
                                                                    <input type="text" class="form-control" readonly
                                                                        value="{{ $payment->network }}" />
                                                                </div>

                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Address</label>
                                                                    <input type="text" class="form-control" readonly
                                                                        value="{{ $payment->address }}"
                                                                        onfocus="this.select();"
                                                                        onmouseup="return false;" />
                                                                </div>
                                                            @endforeach


                                                        </div>

                                                        <button class="btn btn-primary">
                                                            Deposit
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- Modal -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
                Content body end
            ***********************************-->
</x-app-layout>
{{--  --}}
