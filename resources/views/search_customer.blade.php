<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite('resources/js/customer_search.js')
</head>
<body>
  <x-sidebar :username="Auth::user()->username" />
    <div class="w-3/4 mx-auto font-inter mt-5">
    <div class="w-full flex justify-between items-center mb-5 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800">Kundlista</h3>
            <p class="text-slate-500">Här kan du se alla kunder samt redigera eller ta bort kunder</p>
        </div>
        <div class="ml-3">
            <div class="w-full max-w-sm min-w-[200px] relative">
            <div class="relative">
                <input
                id="searchInput"
                class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:ring-sky-200 hover:border-slate-400 shadow-sm focus:shadow-md"
                placeholder="Sök efter kunder..."
                />
                <span
                class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex items-center bg-white rounded "
                >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8 text-slate-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                </span>
            </div>
            </div>
        </div>
    </div>
     
    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
      <table class="w-full text-left table-auto min-w-max">
        <thead>
          <tr>
            <th class="p-4 border-b border-slate-200 bg-slate-50">
              <p class="text-sm font-normal leading-none text-slate-500">
                Förnamn
              </p>
            </th>
            <th class="p-4 border-b border-slate-200 bg-slate-50">
              <p class="text-sm font-normal leading-none text-slate-500">
                Efternamn
              </p>
            </th>
            <th class="p-4 border-b border-slate-200 bg-slate-50">
              <p class="text-sm font-normal leading-none text-slate-500">
                Telefon nr.
              </p>
            </th>
            <th class="p-4 border-b border-slate-200 bg-slate-50">
              <p class="text-sm font-normal leading-none text-slate-500">
                Adress
              </p>
            </th>
            <th class="p-4 border-b border-slate-200 bg-slate-50">
              <p class="text-sm font-normal leading-none text-slate-500">
                Åtgärder
              </p>
            </th>
          </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr class="customer-result hover:bg-slate-50 border-b border-slate-200">
                    <td class="p-4 py-5">
                    <p class="text-sm text-slate-500">{{ $customer->first_name }}</p>
                    </td>
                    <td class="p-4 py-5">
                    <p class="text-sm text-slate-500">{{ $customer->last_name }}</p>
                    </td>
                    <td class="p-4 py-5">
                    <p class="text-sm text-slate-500">{{ $customer->phone }}</p>
                    </td>
                    <td class="p-4 py-5">
                    <p class="text-sm text-slate-500">{{ $customer->address }}</p>
                    </td>
                    <td class="p-4 py-5 flex">
                    <p class="text-sm text-slate-500">Redigera</p>
                    <p class="text-sm text-slate-500 mx-1">|</p>
                    <p class="text-sm text-slate-500">Ta bort</p>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
     
      <div class="flex justify-between items-center px-4 py-3">
        <div class="text-sm text-slate-500">
          Visar <b>{{ $customers->firstItem() }}-{{ $customers->lastItem() }}</b> resultat av {{ $customers->lastPage() }} sida
        </div>
        <div class="flex space-x-1">
            @if ($customers->onFirstPage())
                <span class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded transition duration-200 ease">Föregående</span>
            @else
                <a href="{{ $customers->previousPageUrl() }}" class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">Föregående</a>
            @endif

            @if ($customers->hasMorePages())
                <a href="{{ $customers->nextPageUrl() }}" class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">Nästa</a>
            @else
                <span class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded transition duration-200 ease">Nästa</span>
            @endif
        </div>
      </div>
    </div>    
</div>
</body>
</html>