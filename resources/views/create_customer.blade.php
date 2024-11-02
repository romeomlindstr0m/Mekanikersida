<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="font-inter flex flex-col items-center min-h-screen">

    @if(session('status'))
      <!-- Full-width banner positioned at the top -->
      <div class="w-full">
        <x-status-banner :status="session('status')" />
      </div>
    @endif

    <!-- Main centered container -->
    <div class="flex justify-center items-center flex-grow w-3/5">
      <form action="{{ route('customer.store') }}" method="POST">
        @csrf
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-gray-900">Kundinformation</h2>
            <p class="mt-1 text-sm/6 text-gray-600">Skapa en ny kund till ett projekt här.</p>

            @if ($errors->any())
              <div role="alert" class="mt-3 relative flex flex-col w-full p-3 text-sm text-white bg-slate-800 rounded-md">
                <p class="flex">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                  </svg> 
                  Någonting gick fel:
                </p>
                <ul class="mt-2 ml-7 list-inside list-disc">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-3">
                <label for="first_name" class="block text-sm/6 font-medium text-gray-900">Förnamn</label>
                <div class="mt-2">
                  <input type="text" name="first_name" id="first_name"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-200 sm:text-sm/6">
                </div>
              </div>

              <div class="sm:col-span-3">
                <label for="last_name" class="block text-sm/6 font-medium text-gray-900">Efternamn</label>
                <div class="mt-2">
                  <input type="text" name="last_name" id="last_name"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-200 sm:text-sm/6">
                </div>
              </div>

              <div class="col-span-full">
                <label for="phone" class="block text-sm/6 font-medium text-gray-900">Telefonnummer</label>
                <div class="mt-2">
                  <input type="text" name="phone" id="phone"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-200 sm:text-sm/6">
                </div>
              </div>

              <div class="col-span-full">
                <label for="address" class="block text-sm/6 font-medium text-gray-900">Adress</label>
                <div class="mt-2">
                  <input type="text" name="address" id="address"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-200 sm:text-sm/6">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-6 flex items-center sm:justify-end md:gap-x-6">
          <button type="submit" class="rounded-md bg-gray-900 w-full sm:w-auto px-12 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Skapa</button>
        </div>
      </form>
    </div>
</body>  
</html>
