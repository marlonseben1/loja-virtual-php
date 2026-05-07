<x-app-layout>
    <form method="POST" action="">
        @csrf
        <x-input-label class="mx-3 mt-3">Nome: (Tipo)</x-input-label>
        <x-text-input class="mx-3" id="name" name="name" type='text' required />
        <x-primary-button>Salvar</x-primary-button>
    </form>
</x-app-layout>