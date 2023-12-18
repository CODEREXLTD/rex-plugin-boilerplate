<div class="{{the-plugin-name}}-admin-page" id="{{the-plugin-name}}">
    <div class="main-menu text-white-200 bg-wheat-600 p-4">
        <router-link to="/">
            Home
        </router-link> |
        <router-link to="/custom" >
            Custom
        </router-link>
    </div>
    <hr/>
    <router-view></router-view>
</div>
