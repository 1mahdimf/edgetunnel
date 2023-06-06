<div class="flex items-center justify-center" x-data="{ open: false }">
    <div class="cursor-pointer rounded-full border-none bg-gray-400 px-4 py-2 font-serif text-xl text-white hover:bg-gray-700 focus:outline-none"
        @click="open = true">Open Modal</div>
    <div class="z-1 fixed top-0 left-0 flex h-full w-full items-center justify-center" x-cloak x-show="open">
        <div class="fixed h-full w-full bg-gray-500 opacity-50"></div>

        <div class="z-2 relative mx-auto flex w-3/12 flex-col items-center rounded-lg bg-white p-4 shadow-md"
            @click.away="open = false">
            <div class="absolute -top-5 -left-4 cursor-pointer font-black text-white" @click="open = false">
                <x-heroicon::s-x-mark class="h-6 w-6" />
            </div>
            <p class="pb-3">Hello world, I am a free modal :)</p>
            <button
                class="rounded-full border-none bg-red-400 px-4 py-2 font-serif text-xl text-white hover:bg-red-700 focus:outline-none"
                @click="open = false">Close Modal</button>
        </div>
    </div>
</div>


<div x-data="modal()">
    <button x-on:click="open()" type="button" class="inline-block font-normal text-center px-3 py-2 leading-normal text-base rounded cursor-pointer text-white bg-blue-600" data-toggle="modal" data-target="#exampleModalTwo">
      Launch modal
    </button>
  
    <!-- MODAL CONTAINER WITH BACKDROP -->
    <div x-show="isOpening()">
  
      <!-- MODAL -->
      <div
        :class="{ 'opacity-0': isOpening(), 'opacity-100': isOpen() }"
        class="fixed z-50 top-0 left-0 w-full h-full outline-none transition-opacity duration-200 linear"
        tabindex="-1"
        role="dialog"
      >
  
        <!-- MODAL DIALOG -->
        <div
          :class="{ 'mt-4': isOpening(), 'mt-8': isOpen() }"
          class="relative w-auto pointer-events-none max-w-lg mt-8 mx-auto transition-all duration-200 ease-out"
        >
  
          <!-- MODAL CONTAINER -->
          <div class="relative flex flex-col w-full pointer-events-auto bg-white border border-gray-300 rounded-lg shadow-xl">
            <div class="flex items-start justify-between p-4 border-b border-gray-300 rounded-t">
              <h5 class="mb-0 text-lg leading-normal">Awesome Modal</h5>
              <button
                type="button"
                class="close"
                x-on:click="close()"
              >&times;</button>
            </div>
            <div class="relative flex p-4">
              ...
            </div>
            <div class="flex items-center justify-end p-4 border-t border-gray-300">
              <button
                x-on:click="close()"
                type="button"
                class="inline-block font-normal text-center px-3 py-2 leading-normal text-base rounded cursor-pointer text-white bg-gray-600 mr-2"
              >Close</button>
              <button
                type="button"
                class="inline-block font-normal text-center px-3 py-2 leading-normal text-base rounded cursor-pointer text-white bg-blue-600"
              >Save changes</button>
            </div>
          </div>
        </div>
      </div>
  
      <!-- BACKDROP -->
      <div
        :class="{ 'opacity-25': isOpen() }"
        class="z-40 fixed top-0 left-0 bottom-0 right-0 bg-black opacity-0 transition-opacity duration-200 linear"
      ></div>
    </div>
  </div>
  
  <script>
    function modal() {
      return {
        state: 'CLOSED', // [CLOSED, TRANSITION, OPEN]
        open() {
          this.state = 'TRANSITION'
          setTimeout(() => { this.state = 'OPEN' }, 50)
        },
        close() {
          this.state = 'TRANSITION'
          setTimeout(() => { this.state = 'CLOSED' }, 300)
        },
        isOpen() { return this.state === 'OPEN' },
        isOpening() { return this.state !== 'CLOSED' },
      }
    }
  </script>