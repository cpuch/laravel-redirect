<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Links') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
					<div class="mb-6">
						<form action="">
							<input type="text" class="rounded bg-gray-50 border border-gray-300 text-gray-900 text-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="off" id="search" name="search" placeholder="Search" value="{{ app('request')->input('search') }}">
						</form>
					</div>

					<div class=" mb-6">
						<table class="w-full table-auto text-md text-left text-gray-500 dark:text-gray-400">
							<thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
								<tr>
									<th scope="col" class="p-6">
										#
									</th>
									<th scope="col" class="p-6">
										Code
									</th>
									<th scope="col" class="p-6">
										Description
									</th>
									<th scope="col" class="p-6">
										Actions
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach($links as $link)
								<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
									<th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
										{{ $link->id }}
									</th>
									<td class="py-4 px-6">
										{{ $link->code }}
									</td>
									<td class="py-4 px-6">
										{{ $link->description }}
									</td>
									<td class="py-4 px-6">
										<a href="{{ route('link.edit', $link->id ?? '' ) }}" class="btn btn-sm btn-primary mb-2 mb-md-0" role="button">
											<span class="fas fa-pen fa-fw"></span>
										</a>											
										<span id="tooltip{{ $link->id }}" data-placement="bottom" data-title="Copied" class="btn btn-sm btn-success mb-2 mb-md-0 copylink" role="button" data-clipboard-text="{{ URL::to('/') }}/{{ $link->code ?? '' }}">
											<span class="fas fa-copy fa-fw"></span>
										</span>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div>
						<a href="{{ route('link.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" role="button">Create</a>
					</div>

					<!-- <div class="container">
						<div class="row justify-content-center">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										@if (session('status'))
											<div class="alert alert-success alert-dismissible fade show" role="alert">
												{{ session('status') }}
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										@endif
										<form class="form-horizontal">
											<div class="form-group">
												<div class="input-group">
													<input name="search" type="text" class="form-control" placeholder="Search by code" value="{{app('request')->input('search')}}">
													<div class="input-group-append">
													<button class="btn btn-secondary" type="submit">
														<i class="fa fa-search"></i>
													</button>
													</div>
												</div>
											</div>
										</form>
										<div class="table-responsive text-center">
											<table class="table">
												<thead>
													<tr>
														<th scope="col">#</th>
														<th scope="col">Code</th>
														<th scope="col">Description</th>
														<th scope="col">Actions</th>
													</tr>
												</thead>
												<tbody>
													@foreach($links as $link)
														<tr>
															<td class="align-middle" scope="row">{{ $link->id ?? '' }}</td>
															<td class="align-middle text-truncate"><a id="link{{ $link->id }}" href="{{ route('link.edit', $link->id ?? '' ) }}">{{ $link->code ?? '' }}</a></td>
															<td class="align-middle text-truncate">{{ $link->description ?? '' }}</td>
															<td class="align-middle">
																<a href="{{ route('link.edit', $link->id ?? '' ) }}" class="btn btn-sm btn-primary mb-2 mb-md-0" role="button">
																	<span class="fas fa-pen fa-fw"></span>
																</a>											
																<span id="tooltip{{ $link->id }}" data-placement="bottom" data-title="Copied" class="btn btn-sm btn-success mb-2 mb-md-0 copylink" role="button" data-clipboard-text="{{ URL::to('/') }}/{{ $link->code ?? '' }}">
																	<span class="fas fa-copy fa-fw"></span>
																</span>
																{{-- Ce bloc est en commentaire
																<a href="{{ route('link.redirect', $link->code ?? '' ) }}" class="btn btn-sm btn-success mb-2 mb-md-0" role="button" target="new">
																	<span class="fas fa-eye fa-fw"></span>
																</a>
																<form action="{{ route('link.destroy', $link->id ?? '' ) }}" method="post" class="d-inline">
																	<button class="btn btn-sm btn-danger mb-2  mb-md-0"><span class="fas fa-trash fa-fw"></span></button></td>
																	@method('delete')
																	@csrf
																</form>
																--}}
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
										{{-- $links->appends(['search' => app('request')->input('search')])->links() --}}
										<a href="{{ route('link.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" role="button">Create</a>
									</div>
								</div>
							</div>
						</div>
					</div> -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


