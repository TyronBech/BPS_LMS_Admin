<header>
  <nav class="bg-blue-700 border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto">
      <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img class="rounded-full xl:w-36 xl:h-36 max-w-36 max-h-36 lg:h-34 lg:w-34 md:h-28 md:w-28 sm:h-20 sm:w-20" src="{{ asset('img/School Logo.png') }}" alt="School Logo">
        <div class="flex flex-col justify-center">
          <h1 class="xl:2xl lg:text-xl md:text-md text-xs text-white font-semibold text-center">Bicutan Parochial School</h1>
          <hr class="h-px bg-gray-200 border-0">
          <h1 class="xl:2xl lg:text-xl md:text-md text-xs text-white font-semibold text-center">Library Management System</h1>
        </div>
      </a>
      <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 mx-2 justify-center md:bg-blue-300 text-sm text-gray-500 rounded-lg lg:hidden md:hover:bg-blue-100 focus:outline-none focus:ring-2 md:focus:ring-gray-200" aria-controls="navbar-dropdown" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>
      <div class="hidden w-full lg:block lg:w-auto pt-4" id="navbar-dropdown">
        <ul class="flex flex-col font-medium p-4 lg:p-0 mt-4 mx-8 mb-4 border border-gray-100 rounded-lg bg-blue-700 lg:space-x-8 rtl:space-x-reverse lg:flex-row lg:mt-0 lg:border-0 lg:bg-blue-700">
          <li>
            <a href="{{ route('dashboard') }}" class="block py-2 px-3 text-white bg-blue-700 rounded hover:underline lg:bg-transparent lg:text-white lg:p-0" aria-current="page">Home</a>
          </li>
          <li>
            <button id="dropdownNavbarLink" data-dropdown-toggle="navbarReport" class="flex items-center justify-between w-full py-2 px-3 text-white rounded hover:underline lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-100 lg:p-0 lg:w-auto">Reports <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
              </svg></button>
            <!-- Dropdown menu -->
            <div id="navbarReport" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
              <ul class="py-2 text-sm text-gray-900" aria-labelledby="dropdownLargeButton">
                <li>
                  <a href="{{ route('report.user') }}" class="flex pl-2 py-2 hover:bg-gray-300">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                      <path fill-rule="evenodd" d="M7 2a2 2 0 0 0-2 2v1a1 1 0 0 0 0 2v1a1 1 0 0 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H7Zm3 8a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm-1 7a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3 1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
                    </svg>
                    <span class="ms-2">User logs</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('report.visitor') }}" class="flex pl-2 py-2 hover:bg-gray-300">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                      <path fill-rule="evenodd" d="M7 2a2 2 0 0 0-2 2v1a1 1 0 0 0 0 2v1a1 1 0 0 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H7Zm3 8a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm-1 7a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3 1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
                    </svg>
                    <span class="ms-2">Visitor logs</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('report.transaction') }}" class="flex pl-2 py-2 hover:bg-gray-300">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                      <path fill-rule="evenodd" d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z" clip-rule="evenodd" />
                    </svg>
                    <span class="ms-2">Transactions</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('report.book-circulation') }}" class="flex pl-2 py-2 hover:bg-gray-300">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                      <path fill-rule="evenodd" d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z" clip-rule="evenodd" />
                    </svg>
                    <span class="ms-2">Book Circulation</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <button id="dropdownNavbarLink" data-dropdown-toggle="navbarImport" class="flex items-center justify-between w-full py-2 px-3 text-white rounded hover:underline lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-100 lg:p-0 lg:w-auto">Imports <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
              </svg></button>
            <!-- Dropdown menu -->
            <div id="navbarImport" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
              <ul class="py-2 text-sm text-gray-900" aria-labelledby="dropdownLargeButton">
                <li>
                  <a href="{{ route('import.import-students') }}" class="flex pl-2 py-2 hover:bg-gray-300">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                      <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd" />
                    </svg>
                    <span class="ms-2">Students</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('import.import-books') }}" class="flex pl-2 py-2 hover:bg-gray-300">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                      <path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z" clip-rule="evenodd" />
                    </svg>
                    <span class="ms-2">Books</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <button id="dropdownNavbarLink" data-dropdown-toggle="navbarMaintenance" class="flex items-center justify-between w-full py-2 px-3 text-white rounded hover:underline lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-100 lg:p-0 lg:w-auto">Maintenance <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
              </svg></button>
            <!-- Dropdown menu -->
            <div id="navbarMaintenance" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
              <ul class="py-2 text-sm text-gray-900" aria-labelledby="dropdownLargeButton">
                <li>
                  <a href="{{ route('maintenance.students') }}" class="flex pl-2 py-2 hover:bg-gray-300">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                      <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd" />
                    </svg>
                    <span class="ms-2">Students</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('maintenance.books') }}" class="flex pl-2 py-2 hover:bg-gray-300">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                      <path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z" clip-rule="evenodd" />
                    </svg>
                    <span class="ms-2">Books</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="flex pl-2 py-2 hover:bg-gray-300">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M16 10c0-.55228-.4477-1-1-1h-3v2h3c.5523 0 1-.4477 1-1Z" />
                      <path d="M13 15v-2h2c1.6569 0 3-1.3431 3-3 0-1.65685-1.3431-3-3-3h-2.256c.1658-.46917.256-.97405.256-1.5 0-.51464-.0864-1.0091-.2454-1.46967C12.8331 4.01052 12.9153 4 13 4h7c.5523 0 1 .44772 1 1v9c0 .5523-.4477 1-1 1h-2.5l1.9231 4.6154c.2124.5098-.0287 1.0953-.5385 1.3077-.5098.2124-1.0953-.0287-1.3077-.5385L15.75 16l-1.827 4.3846c-.1825.438-.6403.6776-1.0889.6018.1075-.3089.1659-.6408.1659-.9864v-2.6002L14 15h-1ZM6 5.5C6 4.11929 7.11929 3 8.5 3S11 4.11929 11 5.5 9.88071 8 8.5 8 6 6.88071 6 5.5Z" />
                      <path d="M15 11h-4v9c0 .5523-.4477 1-1 1-.55228 0-1-.4477-1-1v-4H8v4c0 .5523-.44772 1-1 1s-1-.4477-1-1v-6.6973l-1.16797 1.752c-.30635.4595-.92722.5837-1.38675.2773-.45952-.3063-.5837-.9272-.27735-1.3867l2.99228-4.48843c.09402-.14507.2246-.26423.37869-.34445.11427-.05949.24148-.09755.3763-.10887.03364-.00289.06747-.00408.10134-.00355H15c.5523 0 1 .44772 1 1 0 .5523-.4477 1-1 1Z" />
                    </svg>
                    <span class="ms-2">Admin</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <form action="{{ route('admin.logout') }}" method="POST">
              @csrf
              <button type="submit" class="block py-2 px-3 text-white rounded hover:underline lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-100 lg:p-0">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>