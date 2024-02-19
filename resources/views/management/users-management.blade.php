<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card">
                        <div class="pb-0 card-header">
                            @if (session('status'))
                                <div class="alert alert-info text-sm" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('errors'))
                                <div class="alert alert-danger text-sm" role="alert">
                                    Une erreur est survenue veillez verifier les champs et recommencez.
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">User Management</h5>
                                    <p class="mb-0 text-sm">
                                        Here you can manage users.
                                    </p>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-dark btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        <i class="fas fa-user-plus me-2"></i> Add User
                                    </button>
                                </div>
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <form role="form" method="POST" action="users-add" class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Add a new user.</h5>
                                                <button type="button" class="btn btn-close btn-secondary"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <label>Name</label>
                                                <div class="mb-3">
                                                    <input type="text" id="name" name="name"
                                                        class="form-control" placeholder="Enter your name"
                                                        value="{{ old('name') }}" aria-label="Name"
                                                        aria-describedby="name-addon">
                                                    @error('name')
                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <label>Entreprise</label>
                                                <div class="mb-3">
                                                    <input type="text" id="societe" name="societe"
                                                        class="form-control" placeholder="Enter your entreprise name"
                                                        value="{{ old('societe') }}" aria-label="societe"
                                                        aria-describedby="societe-addon">
                                                    @error('societe')
                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <label>Email Address</label>
                                                <div class="mb-3">
                                                    <input type="email" id="email" name="email"
                                                        class="form-control" placeholder="Enter your email address"
                                                        value="{{ old('email') }}" aria-label="Email"
                                                        aria-describedby="email-addon">
                                                    @error('email')
                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <label>Phone number</label>
                                                <div class="mb-3">
                                                    <input type="text" maxlength="12" id="phone" name="phone"
                                                        class="form-control" placeholder="237699887766"
                                                        value="{{ old('phone') }}" aria-label="Email"
                                                        aria-describedby="phone-addon">
                                                    @error('phone')
                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <label>Password</label>
                                                <div class="mb-3">
                                                    <input type="password" id="password" name="password"
                                                        class="form-control" placeholder="Create a password"
                                                        aria-label="Password" aria-describedby="password-addon">
                                                    @error('password')
                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-check form-check-info text-left mb-0">
                                                    <input class="form-check-input" type="checkbox" name="terms"
                                                        id="terms" required>
                                                    <label class="font-weight-normal text-dark mb-0" for="terms">
                                                        I agree the <a href="javascript:;"
                                                            class="text-dark font-weight-bold">Terms and
                                                            Conditions</a>.
                                                    </label>
                                                    @error('terms')
                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="">
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert" id="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert" id="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-secondary text-center">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Photo</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Name</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Email</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Entreprise</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Date</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="align-middle bg-transparent border-bottom">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <img src="../assets/img/team-1.jpg" class="rounded-circle mr-2"
                                                        alt="user1" style="height: 36px; width: 36px;">
                                                </div>
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom">{{ $user->name }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom">{{ $user->email }}
                                            </td>
                                            <td class="text-center align-middle bg-transparent border-bottom">
                                                {{ $user->societe }}</td>
                                            <td class="text-center align-middle bg-transparent border-bottom">
                                                {{ $user->created_at }}
                                            @if ($user->email_verified_at ==null)
                                            <i
                                            class="fas fa-check-circle text-secondary ms-2"></i>
                                            @else
                                            <i
                                            class="fas fa-check-circle text-success ms-2"></i>
                                            @endif
                                            </td>
                                            <td class="text-center align-middle bg-transparent border-bottom">
                                                <a href="/users-edit/{{$user->id}}"><i class="fas fa-user-edit"
                                                        aria-hidden="true"></i></a>
                                                <a href="users-delete/{{$user->id}}"><i class="fas fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>

</x-app-layout>

<script src="/assets/js/plugins/datatables.js"></script>
<script>
    const dataTableBasic = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: true,
        columns: [{
            select: [2, 6],
            sortable: false
        }]
    });
</script>
