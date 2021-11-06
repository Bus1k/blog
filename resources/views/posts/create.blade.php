<x-layout>
    <section class="py-8 max-w-md mx-auto">
        <h1 class="text-lg font-bold mb-4">Publish New Post</h1>

        <x-panel class="">
            <form action="{{ route('store-post') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <x-form.input name="title" />
                <x-form.input name="thumbnail" type="file" />

                <x-form.textarea name="excerpt" />
                <x-form.textarea name="body" />

                <x-form.field>
                    <x-form.label name="Category"/>

                    <select name="category_id" id="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') === $category->id ? 'selected' : '' }}>{{ ucwords($category->name) }}</option>
                        @endforeach
                    </select>

                    <x-form.error name="category"/>
                </x-form.field>

                <x-form.button>Publish</x-form.button>
            </form>

        </x-panel>
    </section>
</x-layout>
