<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <x-app.navbar />
        <div class="px-5 py-4 container-fluid ">
            <form action="/contacts-update/{{ $contact->id }}" method="POST">
                @csrf
                @method('PUT')
                <a href="/contacts">back</a>
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-12">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert" id="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" role="alert" id="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mb-5 row justify-content-center">
                    <div class="col-lg-4 col-12 ">
                        <div class="card " id="basic-info">
                            <div class="card-header">
                                <h5>Contact Info</h5>
                            </div>
                            <div class="pt-0 card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ old('name', $contact->name) }}" class="form-control">
                                        @error('name')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" maxlength="12" id="phone"
                                            placeholder="237699887766" value="{{ old('phone', $contact->phone) }}"
                                            class="form-control">
                                        @error('phone')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Save
                                    changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <x-app.footer />
        </div>
    </main>

</x-app-layout>
