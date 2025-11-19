<x-admin.layout>
    <main class="page-my-cars">
        <div>
            @if (session('success'))
                <div class="alert success-alert">
                    <span><strong>✅ Success:</strong> {{ session('success') }}</span>
                    <button class="close-btn" onclick="this.parentElement.remove()">×</button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert error-alert">
                    <span><strong>❌ Error:</strong> {{ session('error') }}</span>
                    <button class="close-btn" onclick="this.parentElement.remove()">×</button>
                </div>
            @endif

            <div class="container">
                <div class="mb-medium flex justify-between items-center">
                    <h1 class="car-details-page-title">All Users</h1>

                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" style="width: 18px; margin-right: 4px">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Add New User
                    </a>
                </div>

                <div class="card p-medium">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>

                                    @if($user->role === 'admin')
                                        <td class="text-gray-500 italic">No actions available</td>
                                    @endif

                                    <td class="">
                                        {{-- View --}}
                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                           class="btn btn-edit inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                 style="width: 12px; margin-right: 5px">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 0c0 1.886-.43 3.667-1.2 5.25a.75.75 0 0 1-.51.39c-2.28.43-4.68.66-7.29.66s-5.01-.23-7.29-.66a.75.75 0 0 1-.51-.39A12.448 12.448 0 0 1 3 12c0-1.886.43-3.667 1.2-5.25a.75.75 0 0 1 .51-.39c2.28-.43 4.68-.66 7.29-.66s5.01.23 7.29.66a.75.75 0 0 1 .51.39A12.448 12.448 0 0 1 21 12Z" />
                                            </svg>
                                            View
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                           class="btn btn-edit inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                 style="width: 12px; margin-right: 5px">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                            Edit
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                                              method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-delete inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                     style="width: 12px; margin-right: 5px">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-large">
                                        No users found.
                                        <a href="{{ route('admin.users.create') }}">Add a new user</a>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $users->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </main>
</x-admin.layout>
