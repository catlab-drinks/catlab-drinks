<!--
  - CatLab Drinks - Simple bar automation system
  - Copyright (C) 2019 Thijs Van der Schaeghe
  - CatLab Interactive bvba, Gent, Belgium
  - http://www.catlab.eu/
  -
  - This program is free software; you can redistribute it and/or modify
  - it under the terms of the GNU General Public License as published by
  - the Free Software Foundation; either version 3 of the License, or
  - (at your option) any later version.
  -
  - This program is distributed in the hope that it will be useful,
  - but WITHOUT ANY WARRANTY; without even the implied warranty of
  - MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  - GNU General Public License for more details.
  -
  - You should have received a copy of the GNU General Public License along
  - with this program; if not, write to the Free Software Foundation, Inc.,
  - 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
  -->

<template>
    <div>
        <h2>
            Orders
            <b-link class="btn btn-sm btn-info" :to="{ name: 'hq', params: { id: this.eventId } }">
                Bar HQ
            </b-link>

            <b-link class="btn btn-sm btn-info" :to="{ name: 'summary', params: { id: this.eventId } }">
                Summary
            </b-link>
        </h2>

        <div class="text-center" v-if="!loaded && items.length === 0">
            <b-spinner label="Loading data" />
        </div>

        <div class="text-center" v-if="loaded && items.length === 0">
            <p>There don't seem to be any orders, sir...</p>
        </div>

        <div class="order-history">
            <div class="order" v-for="(item, index) in items" :class="'status ' + item.status">

                <order-details :order="item"></order-details>

            </div>
        </div>

    </div>


</template>

<script>

    import {MenuService} from "../services/MenuService";
    import {OrderService} from "../services/OrderService";

    export default {

        props: [
            'eventId'
        ],

        mounted() {


        },

        beforeDestroy() {
            if (this.interval) {
                clearInterval(this.interval);
            }
        },

        data() {
            return {
                loaded: false,
                items: []
            }
        },

        watch: {

            eventId(newVal, oldVal) {

                this.menuService = new MenuService(newVal);
                this.orderService = new OrderService(newVal);

                if (this.interval) {
                    clearInterval(this.interval);
                }

                this.refresh();
                this.interval = setInterval(
                    () => {
                        this.refresh();
                    },
                    5000
                );
            }

        },

        methods: {
            async refresh() {
                this.loaded = false;

                this.items = (await this.orderService.index({
                    sort: '!id',
                    records: 1000
                })).items;

                this.loaded = true;
            }
        }
    }
</script>
