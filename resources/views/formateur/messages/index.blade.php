
@extends('layouts.formateur')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Messages</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Conversations</h5>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($contacts as $contact)
                    <a href="{{ route('formateur.messages.index', ['contact_id' => $contact->id]) }}" 
                       class="list-group-item list-group-item-action {{ request('contact_id') == $contact->id ? 'active' : '' }}">
                        <div class="d-flex align-items-center">
                            <div class="user-avatar me-2" style="width: 40px; height: 40px;">
                                {{ strtoupper(substr($contact->nom, 0, 2)) }}
                            </div>
                            <div>
                                <strong>{{ $contact->nom }}</strong>
                                <small class="d-block text-muted">{{ $contact->role }}</small>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="list-group-item text-center text-muted">
                        Aucune conversation
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Messages</h5>
                </div>
                <div class="card-body" style="height: 400px; overflow-y: auto;">
                    @forelse($messages as $message)
                    <div class="mb-3 {{ $message->sender_id == auth()->id() ? 'text-end' : '' }}">
                        <div class="d-inline-block p-3 rounded {{ $message->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-light' }}" style="max-width: 70%;">
                            <small class="d-block mb-1">{{ $message->sender->nom }}</small>
                            <p class="mb-1">{{ $message->message }}</p>
                            <small class="{{ $message->sender_id == auth()->id() ? 'text-white-50' : 'text-muted' }}">
                                {{ $message->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-muted py-4">Aucun message</p>
                    @endforelse
                </div>
                <div class="card-footer">
                    <form action="{{ route('formateur.messages.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ request('contact_id') }}">
                        <div class="input-group">
                            <input type="text" name="message" class="form-control" placeholder="Votre message..." required>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection