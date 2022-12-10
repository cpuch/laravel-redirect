<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

	{{--
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">Dashboard</div>
									<div class="card-body">
										@if (session('status'))
											<div class="alert alert-success" role="alert">
												{{ session('status') }}
											</div>
										@endif
										<form method="POST" actions="{{ route('link.update', $link->id) }}">
											@csrf
											@method('put')
											<!-- Code -->
											<div class="form-group row">
												<label for="code" class="col-sm-4 col-form-label font-weight-bold">
														Code
														<small class="form-text text-muted">Create your custom alias.</small>
												</label>
												<div class="col-sm-8">
													<div class="input-group mb-2">
														<div class="input-group-prepend d-none d-lg-block">
															<div class="input-group-text">{{ env('APP_URL')}}</div>
														</div>
														<input type="text" class="form-control" autocomplete="off" maxlength="100" id="code" name="code" value="{{ $link->code }}" disabled>
													</div>
													@error('code')
														<div class="alert alert-danger mt-2 is-dismissable fade show">{{ $message }}</div>
													@enderror
												</div>
											</div>
											<!-- Description -->
											<div class="form-group row">
												<label for="description" class="col-sm-4 col-form-label font-weight-bold">
													Description
													<small class="form-text text-muted">Add a brief description for context.</small>
												</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" maxlength="150" id="description" name="description" value="{{ $link->description }}">
												</div>
											</div>
											<!-- Default URL -->
											<div class="form-group row">
												<label for="default_url" class="col-sm-4 col-form-label font-weight-bold">
													Default URL
													<small class="form-text text-muted">Send the visitor to this URL if from an unspecified country.</small>
												</label>
												<div class="col-sm-8">
													<input type="url" class="form-control" id="default_url" name="default_url" value="{{ $link->default_url }}">
													@error('default_url')
														<div class="alert alert-danger mt-2 is-dismissable fade show">{{ $message }}</div>
													@enderror
												</div>
											</div>
											<!-- Robot URL -->
											<div class="form-group row">
												<label for="robot_url" class="col-sm-4 col-form-label font-weight-bold">
													Robot URL
													<small class="form-text text-muted">Send crawling bots to this URL. If empty, redirects robots to the default URL.</small>
												</label>
												<div class="col-sm-8">
													<input type="url" class="form-control" id="robot_url" name="robot_url" value="{{ $link->robot_url }}">
												</div>
											</div>
											<!-- Country Destinations -->
											<div class="form-group row">
												<label for="country_url" class="col-sm-4 col-form-label font-weight-bold">
													Country Destinations
													<small class="form-text text-muted">Override the Default URL and redirect the visitor to a country-specific destination.</small>
												</label>
												<div class="col-sm-8">
													<div class="container px-0">
														<div class="form-group row">
															<div class="col-sm-12">
																<div class="form-check">
																	<input type="checkbox" class="form-check-input" id="id-usa-auto-create" name="usa-auto-create" value="1" checked>
																	<label class="form-check-label" for="id-usa-auto-create">Create url for Canada, Mexico, Brazil, and Argentina when United State is selected as a country and none of that countries are selected.</label>
																</div>
															</div>
														</div>
													</div>
													<div class="container px-0" data-role="dynamic-fields" data-limit="{{ count($countries) }}">
														@forelse($link->country_url as $key => $value)
															<div class="form-group row">
																<div class="col-sm-6">
																	<input type="url" class="form-control" name="country_url[{{ $key }}][url]" value="{{ $value['url'] }}">
																</div>
																<div class="col-sm-4 mt-2 mt-sm-0">
																	<select class="custom-select" name="country_url[{{ $key }}][code]">
																		<option value="">Select a Country</option>
																		@foreach($countries as $country)
																			<option value="{{ $country->code }}" {{ ($country->code == $value['code']) ? 'selected' : '' }}>{{ $country->name }}</option>
																		@endforeach
																	</select>
																</div>
																<div class="col-sm-2 mt-2 mt-sm-0">
																	<button class="btn btn-success" data-role="add">
																		<span class="fas fa-plus fa-fw"></span>
																	</button>
																	<button class="btn btn-danger" data-role="remove">
																		<span class="fas fa-minus fa-fw"></span>
																	</button>
																	<button class="btn btn-primary" data-role="view">
																		<span class="fas fa-eye fa-fw"></span>
																	</button>
																</div>
															</div>
														@empty
															<div class="form-group row">
																<div class="col-sm-6">
																	<input type="url" class="form-control" name="country_url[0][url]" value="">
																</div>
																<div class="col-sm-4 mt-2 mt-sm-0">
																	<select class="custom-select" name="country_url[0][code]">
																		<option value="">Select a Country</option>
																		@foreach($countries as $country)
																			<option value="{{ $country->code }}">{{ $country->name }}</option>
																		@endforeach
																	</select>
																</div>
																<div class="col-sm-2 mt-2 mt-sm-0">
																	<button class="btn btn-success" data-role="add">
																		<span class="fas fa-plus fa-fw"></span>
																	</button>
																	<button class="btn btn-danger" data-role="remove">
																		<span class="fas fa-minus fa-fw"></span>
																	</button>
																	<button class="btn btn-primary" data-role="view">
																		<span class="fas fa-eye fa-fw"></span>
																	</button>
																</div>
															</div>
														@endforelse
													</div>
												</div>
											</div>
											<!-- Device Destinations -->
											<div class="form-group row">
												<label for="device_url" class="col-sm-4 col-form-label font-weight-bold">
													Device Destinations
													<small class="form-text text-muted">Override the Default URL and redirect the visitor to a device-specific destination.</small>
												</label>
												<div class="col-sm-8">
													<div class="container px-0" data-role="dynamic-fields" data-limit="4">
														@forelse($link->device_url as $key => $value)
															<div class="form-group row">
																<div class="col-sm-6">
																	<input type="url" class="form-control" id="device" name="device_url[{{ $key }}][url]" value="{{ $value['url'] }}">
																</div>
																<div class="col-sm-4 mt-2 mt-sm-0">
																	<select class="custom-select" name="device_url[{{ $key }}][code]">
																		<option value="">Select a Device</option>
																		<option value="iphone" {{ ('iphone' == $value['code']) ? 'selected' : '' }}>iPhone</option>
																		<option value="ipad" {{ ('ipad' == $value['code']) ? 'selected' : '' }}>iPad</option>
																		<option value="android" {{ ('android' == $value['code']) ? 'selected' : '' }}>Android</option>
																		<option value="windows-phone" {{ ('windows-phone' == $value['code']) ? 'selected' : '' }}>Windows Phone</option>
																	</select>
																</div>
																<div class="col-sm-2 mt-2 mt-sm-0">
																	<button class="btn btn-success" data-role="add">
																		<span class="fas fa-plus fa-fw"></span>
																	</button>
																	<button class="btn btn-danger" data-role="remove">
																		<span class="fas fa-minus fa-fw"></span>
																	</button>
																	<button class="btn btn-primary" data-role="view">
																		<span class="fas fa-eye fa-fw"></span>
																	</button>
																</div>
															</div>
														@empty
															<div class="form-group row">
																<div class="col-sm-6">
																	<input type="url" class="form-control" id="device" name="device_url[0][url]" value="">
																</div>
																<div class="col-sm-4 mt-2 mt-sm-0">
																	<select class="custom-select" name="device_url[0][code]">
																		<option value="">Select a Device</option>
																		<option value="iphone">iPhone</option>
																		<option value="ipad">iPad</option>
																		<option value="android">Android</option>
																		<option value="windows-phone">Windows Phone</option>
																	</select>
																</div>
																<div class="col-sm-2 mt-2 mt-sm-0">
																	<button class="btn btn-success" data-role="add">
																		<span class="fas fa-plus fa-fw"></span>
																	</button>
																	<button class="btn btn-danger" data-role="remove">
																		<span class="fas fa-minus fa-fw"></span>
																	</button>
																	<button class="btn btn-primary" data-role="view">
																		<span class="fas fa-eye fa-fw"></span>
																	</button>
																</div>
															</div>
														@endforelse
													</div>
												</div>
											</div>
											<!-- Button -->
											<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
											<a href="{{ url()->previous() }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
	--}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded">
                <div class="p-6 text-gray-900 dark:text-gray-100">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										@if (session('status'))
											<div class="alert alert-success alert-dismissible fade show" role="alert">
												{{ session('status') }}
											</div>
										@endif
										<form method="POST" actions="{{ route('link.store') }}">
											@csrf
											@method('PUT')
											<!-- Code -->
											<div class="mb-6">
												<label for="code" class="block text-md font-medium text-gray-900 dark:text-white">
													Code
												</label>
												<p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Create your custom alias. This field is required.</p>
												<div class="flex">
													<span class="inline-flex items-center px-3 text-gray-900 bg-gray-50 rounded-l-md border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
														{{ env('APP_URL') }}
													</span>
													<input type="text" class="rounded-none rounded-r-md bg-gray-50 border border-gray-300 text-gray-900 text-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="off" maxlength="100" id="code" name="code" value="{{ $link->code }}">
												</div>
												@error('code')
													<div class="alert alert-danger mt-2 is-dismissable fade show">
														{{ $message }}
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
												@enderror
											</div>
											<!-- Description -->
											<div class="mb-6">
												<label for="description" class="block text-md font-medium text-gray-900 dark:text-white">
													Description
												</label>
												<p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Add a brief description for context.</p>
												<div class="col-sm-8">
													<input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" maxlength="150" id="description" name="description" value="{{ $link->description }}">
												</div>
											</div>
											<!-- Default URL -->
											<div class="mb-6">
												<label for="default_url" class="block text-md font-medium text-gray-900 dark:text-white">
													Default URL
												</label>
												<p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Send the visitor to this URL if from an unspecified country and device. This field is required.</p>
												<input type="url" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="default_url" name="default_url" value="{{ $link->default_url }}">
												@error('default_url')
													<div class="alert alert-danger mt-2 is-dismissable fade show">
														{{ $message }}
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
												@enderror
											</div>
											<!-- Robot URL -->
											<div class="mb-6">
												<label for="robot_url" class="block text-md font-medium text-gray-900 dark:text-white">
													Robot URL
												</label>
												<p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Send crawling bots to this URL. If empty, robots are redirected to the default URL.</p>
												<div class="col-sm-8">
													<input type="url" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="robot_url" name="robot_url" value="{{ $link->robot_url }}">
												</div>
											</div>
											<!-- Country Destinations -->
											<div class="mb-6">
												<label for="country_url" class="block text-md font-medium text-gray-900 dark:text-white">
													Country Destinations
												</label>
												<p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Override the Default URL and redirect the visitor to a country-specific destination..</p>
												<div class="col-sm-8">
													<div class="container px-0" data-role="dynamic-fields" data-limit="{{ count($countries) }}">
														@forelse($link->country_url as $key => $value)
														<div class="form-group row">
															<div class="col-sm-4 mb-2 mt-sm-0">
																<select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="country_url[{{ $key }}][code]">
																	<option value="">Select a Country</option>
																	@foreach($countries as $country)
																	<option value="{{ $country->code }}" {{ ($country->code == $value['code']) ? 'selected' : '' }}>{{ $country->name }}</option>
																	@endforeach
																</select>
															</div>
															<div class="col-sm-6 mb-2">
																<input type="url" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="country_url[{{ $key }}][url]" value="{{ $value['url'] }}">
															</div>
															<div class="col-sm-2">
																<button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" data-role="add">
																	<span class="fas fa-plus fa-fw"></span>
																</button>
																<button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" data-role="remove">
																	<span class="fas fa-minus fa-fw"></span>
																</button>
																<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-role="view">
																	<span class="fas fa-eye fa-fw"></span>
																</button>
															</div>
														</div>
														@empty
														<div class="form-group row">
															<div class="col-sm-6">
																<input type="url" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="country_url[0][url]" value="">
															</div>
															<div class="col-sm-4 mt-2 mt-sm-0">
																<select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="country_url[0][code]">
																	<option value="">Select a Country</option>
																	@foreach($countries as $country)
																	<option value="{{ $country->code }}" {{ ($country->code == $value['code']) ? 'selected' : '' }}>{{ $country->name }}</option>
																	@endforeach
																</select>
															</div>
															<div class="col-sm-2 mt-2 mt-sm-0">
																<button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" data-role="add">
																	<span class="fas fa-plus fa-fw"></span>
																</button>
																<button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" data-role="remove">
																	<span class="fas fa-minus fa-fw"></span>
																</button>
																<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-role="view">
																	<span class="fas fa-eye fa-fw"></span>
																</button>
															</div>
														</div>
														@endforelse
													</div>
												</div>
											</div>
											<!-- Device Destinations -->
											<div class="mb-6">
												<label for="device_url" class="block text-md font-medium text-gray-900 dark:text-white">
													Device Destinations
												</label>
												<p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Override the Default URL and redirect the visitor to a device-specific destination..</p>
												<div class="col-sm-8">
													<div class="container px-0" data-role="dynamic-fields" data-limit="4">
														@forelse($link->device_url as $key => $value)
														<div class="form-group row">
															<div class="col-sm-4 mb-2">
																<select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="device_url[{{ $key }}][code]">
																	<option value="">Select a Device</option>
																	<option value="iphone" {{ ('iphone' == $value['code']) ? 'selected' : '' }}>iPhone</option>
																	<option value="ipad" {{ ('ipad' == $value['code']) ? 'selected' : '' }}>iPad</option>
																	<option value="android" {{ ('android' == $value['code']) ? 'selected' : '' }}>Android</option>
																	<option value="windows-phone" {{ ('windows-phone' == $value['code']) ? 'selected' : '' }}>Windows Phone</option>
																</select>
															</div>
															<div class="col-sm-6 mb-2">
																<input type="url" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="device_url[{{ $key }}][url]" value="{{ $value['url'] }}">
															</div>
															<div class="col-sm-2">
																<button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" data-role="add">
																	<span class="fas fa-plus fa-fw"></span>
																</button>
																<button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" data-role="remove">
																	<span class="fas fa-minus fa-fw"></span>
																</button>
																<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-role="view">
																	<span class="fas fa-eye fa-fw"></span>
																</button>
															</div>
														</div>
														@empty
														<div class="form-group row">
															<div class="col-sm-4 mb-2">
																<select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="device_url[0][code]">
																	<option value="">Select a Device</option>
																	<option value="iphone" {{ ('iphone' == $value['code']) ? 'selected' : '' }}>iPhone</option>
																	<option value="ipad" {{ ('ipad' == $value['code']) ? 'selected' : '' }}>iPad</option>
																	<option value="android" {{ ('android' == $value['code']) ? 'selected' : '' }}>Android</option>
																	<option value="windows-phone" {{ ('windows-phone' == $value['code']) ? 'selected' : '' }}>Windows Phone</option>
																</select>
															</div>
															<div class="col-sm-6 mb-2">
																<input type="url" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="device_url[0][code]" value="">
															</div>
															<div class="col-sm-2 mb-2">
																<button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" data-role="add">
																	<span class="fas fa-plus fa-fw"></span>
																</button>
																<button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" data-role="remove">
																	<span class="fas fa-minus fa-fw"></span>
																</button>
																<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-role="view">
																	<span class="fas fa-eye fa-fw"></span>
																</button>
															</div>
														</div>
														@endforelse
													</div>
												</div>
											</div>
											<!-- Buttons -->
											<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
											<a href="{{ url()->previous() }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>