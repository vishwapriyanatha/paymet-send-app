<template>
    <v-app id="inspire">
        <v-navigation-drawer
            v-model="drawer"
            app>
            <v-list dense>
                <router-link :to="{'name':'payment'}">
                    <v-list-item link>
                        <v-list-item-action>
                            <v-icon>mdi-home</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>Payment</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar
            app
            color="indigo"
            dark>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>Payment</v-toolbar-title>
            <select @change="logoutUser" class="logout-ddl">
                <option disabled selected>{{ ddl_label }}</option>
                <option>Logout</option>
            </select>
        </v-app-bar>
        <v-main>
            <v-container
                class="fill-height"
                fluid>
                <router-view></router-view>
            </v-container>
        </v-main>
        <v-footer
            color="indigo"
            app>
            <span class="white--text">&copy; {{ current_year }}</span>
        </v-footer>
    </v-app>
</template>

<script>
export default {
    props: {
        source: String,
    },
    data: () => ({
        drawer: true,
        ddl_label: '',
        current_year: ''
    }),
    methods: {
        logoutUser() {
            window.location = '/logout?redirect=/';
        }
    },
    mounted() {
        let self = this;
        axios.get('/user').then((response) => {
            self.ddl_label = response.data.data.name
        });
        let d = new Date();
        self.current_year = d.getFullYear();
    }
}
</script>
