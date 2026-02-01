<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($messages->isEmpty())
                        <p class="text-gray-500 text-center py-4">You haven't sent any messages yet.</p>
                        <div class="text-center">
                             <a href="{{ route('contact') }}" class="text-indigo-600 hover:text-indigo-900">Contact Us</a>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($messages as $message)
                                <div class="border rounded-lg p-4 bg-gray-50">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-bold text-gray-800">Subject: Message Sent</h3> 
                                            <p class="text-sm text-gray-500">{{ $message->created_at->format('M d, Y h:i A') }}</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded {{ $message->reply ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $message->reply ? 'Replied' : 'Pending' }}
                                        </span>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <p class="text-gray-700 italic">"{{ $message->message }}"</p>
                                    </div>

                                    @if($message->reply)
                                        <div class="mt-4 ml-8 border-l-4 border-indigo-500 pl-4 py-2 bg-indigo-50 rounded-r">
                                            <p class="text-xs text-indigo-800 font-bold uppercase mb-1">Admin Reply</p>
                                            <p class="text-gray-800">{{ $message->reply }}</p>
                                            <p class="text-xs text-gray-500 mt-1">Replied on: {{ $message->updated_at->format('M d, Y h:i A') }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
