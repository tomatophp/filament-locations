<div
    class="grid grid-cols-1 lg:grid-cols-3 gap-4"
>
    <x-splade-select remote-root="data" remote-url="{{url('admin/countries/api')}}" option-value="id" option-label="name" label="{{__('Country')}}" name="country_id"  placeholder="{{__('Country')}}" choices />
    <x-splade-select v-bind:disabled="!form.country_id" remote-root="data" remote-url="`{{url('admin/cities/api?country_id=')}}${form.country_id}`" option-value="id" option-label="name" label="{{__('City')}}" name="city_id"  placeholder="{{__('City')}}" choices />
    <x-splade-select v-bind:disabled="!form.city_id" remote-root="data" remote-url="`{{url('admin/areas/api?city_id=')}}${form.city_id}`" option-value="id" option-label="name" label="{{__('Area')}}" name="area_id"  placeholder="{{__('Area')}}" choices />
</div>
