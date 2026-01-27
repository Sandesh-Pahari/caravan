@extends('admin.dashboard')

@section('content')
    <div class="max-w-5xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-bold text-brand-dark">Contact Messages</h1>
                <p class="text-sm text-gray-400 mt-0.5">
                    Contact &rsaquo; Messages
                    @if($unreadCount > 0)
                        &nbsp;·&nbsp;
                        <span class="text-brand-maroon font-medium">{{ $unreadCount }} unread</span>
                    @endif
                </p>
            </div>
            <div class="flex items-center gap-3">
                @if($unreadCount > 0)
                    <form method="POST" action="{{ route('admin.contact.mark-all-read') }}">
                        @csrf
                        <button type="submit"
                                class="text-xs text-brand-blue hover:underline">
                            Mark all read
                        </button>
                    </form>
                @endif
                <a href="{{ route('admin.dashboard') }}" class="text-sm text-brand-blue hover:underline">← Back</a>
            </div>
        </div>

        {{-- Filter Tabs --}}
        <div class="flex gap-2 mb-6 border-b border-gray-200">
            @foreach(['all' => 'All', 'unread' => 'Unread', 'read' => 'Read'] as $key => $label)
                <a href="{{ request()->fullUrlWithQuery(['filter' => $key]) }}"
                   class="px-4 py-2 text-sm font-medium border-b-2 transition -mb-px
                       {{ $filter === $key
                           ? 'border-brand-blue text-brand-blue'
                           : 'border-transparent text-gray-500 hover:text-brand-dark' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            @if($messages->isEmpty())
                <div class="py-16 text-center text-gray-400 text-sm">No messages found.</div>
            @else
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                        <tr>
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Sender</th>
                            <th class="px-4 py-3 text-left">Message Preview</th>
                            <th class="px-4 py-3 text-left">Received</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($messages as $msg)
                            <tr class="hover:bg-gray-50 transition {{ $msg->isUnread() ? 'bg-blue-50/30' : '' }}">
                                <td class="px-4 py-3 text-gray-400 font-mono text-xs">
                                    #{{ $msg->id }}
                                    @if($msg->isUnread())
                                        <span class="inline-block w-2 h-2 rounded-full bg-brand-blue ml-1 align-middle"></span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-medium text-brand-dark">{{ $msg->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $msg->email }}</p>
                                    @if($msg->phone)
                                        <p class="text-xs text-gray-400">{{ $msg->phone }}</p>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-500 text-xs max-w-xs">
                                    {{ Str::limit($msg->message, 80) }}
                                </td>
                                <td class="px-4 py-3 text-gray-500 text-xs">
                                    {{ $msg->created_at->format('d M Y') }}<br>
                                    <span class="text-gray-400">{{ $msg->created_at->format('h:i A') }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    @if($msg->isUnread())
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">Unread</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">Read</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.contact.show', $msg) }}"
                                           class="text-brand-blue hover:underline text-xs font-medium">View</a>
                                        <form method="POST" action="{{ route('admin.contact.destroy', $msg) }}"
                                              onsubmit="return confirm('Delete this message permanently?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($messages->hasPages())
                    <div class="px-4 py-3 border-t border-gray-100">
                        {{ $messages->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
