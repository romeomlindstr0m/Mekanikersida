<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>
<body class="font-inter flex flex-col items-center min-h-screen">
    <x-sidebar :username="Auth::user()->username" />

    @if(session('status'))
      <div class="w-full">
        <x-status-banner :status="session('status')" />
      </div>
    @endif

    <div class="flex justify-center items-center flex-grow w-3/5">
      <form class="w-full" action="#" method="#">
        @csrf
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-gray-900">Projektinformation</h2>
            <p class="mt-1 text-sm/6 text-gray-600">Skapa ett nytt projekt här</p>

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

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
              <div class="col-span-full">
                <label for="name" class="block text-sm/6 font-medium text-gray-900">Projekt Namn</label>
                <div class="mt-2">
                  <input type="text" name="name" id="name"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-200 sm:text-sm/6">
                </div>
              </div>

              <div class="col-span-full">
                <label for="car_model" class="block text-sm/6 font-medium text-gray-900">Bilmodell</label>
                <div class="mt-2">
                  <input type="text" name="car_model" id="car_model"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-200 sm:text-sm/6">
                </div>
              </div>

              <div class="col-span-full">
                <label for="car_make" class="block text-sm/6 font-medium text-gray-900">Bilmärke</label>
                <div class="mt-2">
                  <input type="text" name="car_make" id="car_make"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-200 sm:text-sm/6">
                </div>
              </div>

              <div class="col-span-full">
                <label for="car_year" class="block text-sm/6 font-medium text-gray-900">Årsmodell</label>
                <div class="mt-2">
                  <input type="number" name="car_year" id="car_year"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-200 sm:text-sm/6">
                </div>
              </div>

              <div class="col-span-full">
                <label for="license_plate" class="block text-sm/6 font-medium text-gray-900">Registernummer</label>
                <div class="mt-2">
                  <input type="text" name="license_plate" id="license_plate"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-200 sm:text-sm/6">
                </div>
              </div>

              <div class="col-span-full">
                <label for="customer_id" class="block text-sm/6 font-medium text-gray-900">Kund</label>
                <div class="mt-2">
                    <div x-data="{
                        allOptions: [
                            { 
                                label: 'Acura',
                                value: 'Acura'
                            },
                        ],
                        options: [],
                        isOpen: false,
                        openedWithKeyboard: false,
                        selectedOption: null,
                        setSelectedOption(option) {
                            this.selectedOption = option
                            this.isOpen = false
                            this.openedWithKeyboard = false
                            this.$refs.hiddenTextField.value = option.value
                        },
                        getFilteredOptions(query) {
                            this.options = this.allOptions.filter((option) =>
                                option.label.toLowerCase().includes(query.toLowerCase()),
                            )
                            if (this.options.length === 0) {
                                this.$refs.noResultsMessage.classList.remove('hidden')
                            } else {
                                this.$refs.noResultsMessage.classList.add('hidden')
                            }
                        },
                        handleKeydownOnOptions(event) {
                            if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode === 8) {
                                this.$refs.searchField.focus()
                            }
                        },
                    }" class="flex w-full flex-col gap-1" x-on:keydown="handleKeydownOnOptions($event)" x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false" x-init="options = allOptions">
                    <div class="relative">
                        <button type="button" class="inline-flex w-full items-center justify-between gap-2 border border-neutral-300 rounded-md bg-neutral-50 px-4 py-2 text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black" role="combobox" aria-controls="makesList" aria-haspopup="listbox" x-on:click="isOpen = ! isOpen" x-on:keydown.down.prevent="openedWithKeyboard = true" x-on:keydown.enter.prevent="openedWithKeyboard = true" x-on:keydown.space.prevent="openedWithKeyboard = true" x-bind:aria-expanded="isOpen || openedWithKeyboard" x-bind:aria-label="selectedOption ? selectedOption.value : 'Please Select'" >
                            <span class="text-sm font-normal" x-text="selectedOption ? selectedOption.value : 'Please Select'"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"class="size-5" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <input id="make" name="make" x-ref="hiddenTextField" hidden=""/>
                        <div x-show="isOpen || openedWithKeyboard" id="makesList" class="absolute left-0 top-11 z-10 w-full overflow-hidden rounded-md border border-neutral-300 bg-neutral-50" role="listbox" aria-label="industries list" x-on:click.outside="isOpen = false, openedWithKeyboard = false" x-on:keydown.down.prevent="$focus.wrap().next()" x-on:keydown.up.prevent="$focus.wrap().previous()" x-transition x-trap="openedWithKeyboard">
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="1.5" class="absolute left-4 top-1/2 size-5 -translate-y-1/2 text-neutral-600/50" aria-hidden="true" >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                                </svg>
                                <input type="text" class="w-full border-b borderneutral-300 bg-neutral-50 py-2.5 pl-11 pr-4 text-sm text-neutral-600 focus:outline-none focus-visible:border-black disabled:cursor-not-allowed disabled:opacity-75" name="searchField" aria-label="Search" x-on:input="getFilteredOptions($el.value)" x-ref="searchField" placeholder="Search" />
                            </div>
                            <ul class="flex max-h-44 flex-col overflow-y-auto">
                                <li class="hidden px-4 py-2 text-sm text-neutral-600" x-ref="noResultsMessage">
                                    <span>No matches found</span>
                                </li>
                                <template x-for="(item, index) in options" x-bind:key="item.value">
                                    <li class="combobox-option inline-flex cursor-pointer justify-between gap-6 bg-neutral-50 px-4 py-2 text-sm text-neutral-600 hover:bg-neutral-900/5 hover:text-neutral-900 focus-visible:bg-neutral-900/5 focus-visible:text-neutral-900 focus-visible:outline-none" role="option" x-on:click="setSelectedOption(item)" x-on:keydown.enter="setSelectedOption(item)" x-bind:id="'option-' + index" tabindex="0">
                                        <span x-bind:class="selectedOption == item ? 'font-bold' : null" x-text="item.label"></span>
                                        <span class="sr-only" x-text="selectedOption == item ? 'selected' : null"></span>
                                        <svg x-cloak x-show="selectedOption == item" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" class="size-4" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5">
                                        </svg>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>                
                </div>
              </div>

              <div class="col-span-full">
                <label for="issue_description" class="block text-sm/6 font-medium text-gray-900">Felbeskrivning</label>
                <div class="mt-2">
                  <textarea rows="3" cols="50" name="issue_description" id="issue_description"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-200 sm:text-sm/6"></textarea>
                </div>
              </div>

              <div class="col-span-full">
                <label for="work_description" class="block text-sm/6 font-medium text-gray-900">Arbetsbeskrivning</label>
                <div class="mt-2">
                  <textarea rows="3" cols="50" name="work_description" id="work_description"
                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-200 sm:text-sm/6"></textarea>
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
