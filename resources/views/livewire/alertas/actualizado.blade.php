


            <div
            x-data="{body: ''}"
            x-show="body.length"
            x-cloak
            x-on:actualizado.window="body = $event.detail.body; setTimeout(() => body = '', $event.detail.timeout || 2000)"
            class="fixed bottom-2 right-2 flex px-4 py-6 items-start pointer-events-none">
            <div class="w-full flex flex-col items-center space-y-4">
                <div class="max-w-sm w-full bg-yellow-600 rounded-lg pointer-events-auto">
                    <div class="p-4 flex items-center">
                        <div class="ml-2 w flex-1 text-white">
                            <span x-text="body"></span>
                        </div>
                        <button class="inline-flex text-gray-400" x-on:click="body = ''">
                            <span class="sr-only">Close</span>
                            <span class="text-2xl">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>