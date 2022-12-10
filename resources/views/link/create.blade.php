<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Link') }}
        </h2>
    </x-slot>

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
											<!-- Code -->
											<div class="mb-6">
												<label for="code" class="block text-md font-medium text-gray-900 dark:text-white">
													Code <span class="text-red-600">*</span>
												</label>
												<p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Create your custom alias. This field is required.</p>
												<div class="flex">
													<span class="inline-flex items-center px-3 text-gray-900 bg-gray-50 rounded-l-md border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
														{{ env('APP_URL') }}
													</span>
													<input type="text" class="rounded-none rounded-r-md bg-gray-50 border border-gray-300 text-gray-900 text-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="off" maxlength="100" id="code" name="code" value="">
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
													<input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" maxlength="150" id="description" name="description" value="">
												</div>
											</div>
											<!-- Default URL -->
											<div class="mb-6">
												<label for="default_url" class="block text-md font-medium text-gray-900 dark:text-white">
													Default URL <span class="text-red-600">*</span>
												</label>
												<p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Send the visitor to this URL if from an unspecified country and device. This field is required.</p>
												<input type="url" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="default_url" name="default_url">
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
													<input type="url" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="robot_url" name="robot_url">
												</div>
											</div>
											<!-- Country Destinations -->
											<div class="mb-6">
												<label for="country_url" class="block text-md font-medium text-gray-900 dark:text-white">
													Country Destinations
												</label>
												<p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Override the Default URL and redirect the visitor to a country-specific destination.</p>
												<div class="" data-role="dynamic-fields" data-limit="{{ count($countries) }}">
													<div class="mb-2">
														<select class="block appearance-none w-full border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="country_url" name="country_url[0][code]">
															<option value="">Select a Country</option>
															@foreach($countries as $country)
															<option value="{{ $country->code }}">{{ $country->name }}</option>
															@endforeach
														</select>
													</div>
													<div class="mb-2">
														<input type="url" class="mb-2-sm bg-gray-50 border border-gray-300 text-gray-900 text-md rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="country_url[0][url]" value="">
													</div>
													<button @click="alert('Hello World!')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" data-role="add">
														<span class="fas fa-plus fa-fw"></span>
													</button>
													<button @click="alert('Hello World!')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" data-role="remove">
														<span class="fas fa-minus fa-fw"></span>
													</button>
													<button @click="alert('Hello World!')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-role="view">
														<span class="fas fa-eye fa-fw"></span>
													</button>
												</div>
											</div>
											<!-- Device Destinations -->
											<div class="mb-6">
												<label for="device_url" class="block text-md font-medium text-gray-900 dark:text-white">
													Device Destinations
												</label>
												<p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Override the Default URL and redirect the visitor to a device-specific destination.</p>
												<div class="" data-role="dynamic-fields" data-limit="4">
													<div class="mb-2">
														<select class="block appearance-none w-full border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="device_url" name="device_url[0][code]">
															<option value="">Select a Device</option>
															<option value="iphone">iPhone</option>
															<option value="ipad">iPad</option>
															<option value="andoird">Android</option>
															<option value="windows-phone">Windows Phone</option>
														</select>
													</div>
													<div class="mb-2">
														<input type="url" class="mb-2-sm bg-gray-50 border border-gray-300 text-gray-900 text-md rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="device_url[0][url]" value="">
													</div>
													<button @click="alert('Hello World!')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" data-role="add">
														<span class="fas fa-plus fa-fw"></span>
													</button>
													<button @click="alert('Hello World!')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" data-role="remove">
														<span class="fas fa-minus fa-fw"></span>
													</button>
													<button @click="alert('Hello World!')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-role="view">
														<span class="fas fa-eye fa-fw"></span>
													</button>
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
