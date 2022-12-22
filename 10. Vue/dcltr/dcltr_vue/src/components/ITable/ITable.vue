<template>

<div class="row">
    <div class="col-6">

    </div>
    <div class="col-6 text-right">
        <select v-model="rows_per_page" @change="updatePerRow({rows_per_page, 'section':section})" v-if="perPageLimit">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="100">100</option>
            
        </select>
    </div>
</div>
<table :class="classes" :id="tableId" :ref="tableId">
    <thead>
        <tr>
            <!-- @click="sortBy(column.title)" :class="sortKey === column.title ? (sortOrders[column.title] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'" -->
            <!-- style="width: 40%; cursor:pointer;" -->
            <template v-for="column in tableHeader" :key="column.title">
                <th>
                    {{ column.title }}
                    <template v-if="column.hasOwnProperty('sort') && column.sort.sortable">
                        <span style="cursor: pointer" @click="sortIt({'section':section, 'sortKey':column.key, 'sortDirection':this.sortable.hasOwnProperty('sortDirection')?this.sortable.sortDirection:column.sort.sortable.direction})">
                            <span v-if="this.sortable.hasOwnProperty('sortDirection') && this.sortable.sortDirection==1 && this.sortable.sortKey==column.key"><i class="fas fa-sort-up"></i></span>
                            <span v-else-if="this.sortable.hasOwnProperty('sortDirection') && this.sortable.sortDirection==-1 && this.sortable.sortKey==column.key"><i class="fas fa-sort-down"></i></span>
                        </span>
                    </template>

                    <!-- <template v-else>
                {{ column.title }}
            </template> -->

                    <!-- <span v-else-if="column.key=='id' && this.sortable.sort=='1'"><i class="fas fa-sort-up"></i></span> -->
                </th>

            </template>
        </tr>
        <tr>
            <template v-for="column in tableHeader" :key="column.title">
                <th v-if="column.hasOwnProperty('filter') && column.filter.filterable && column.filter.key==column.key">
                    <input type="search" class="form-control" v-if="column.filter.type=='text'" @input="filterByKey($event, column)" />
                    <select type="search" class="form-control" v-if="column.filter.type=='select'" @input="filterByKey($event, column)">

                        <option v-for="opt in column.filter.options" :key="opt.key" :value="opt.key">{{opt.value}}</option>
                    </select>
                </th>
                <th v-else></th>
            </template>

        </tr>
    </thead>
    <template v-if="dragStatus && rows.length">
        <draggable v-model="rows" tag="tbody" item-key="id" @change="moveColumn">
            <template #item="{ element }">
                <tr>
                    <template v-for="column in tableHeader" :key="column.key">
                        <template v-if="column?.key">
                            <td v-if="column.hasOwnProperty('titleCase') && !column.key.includes('.')">
                                {{ titleCase(element[column.key]) }}
                            </td>
                            <td style="cursor: all-scroll" v-if="
                column?.key != 'actions' &&
                !column.hasOwnProperty('titleCase') &&
                !column.key.includes('.')
              ">            
                            {{ element[column.key] }}
                            </td>
                            <td v-if="column?.key != 'actions' && column.key.includes('.')">
                                {{ evaluate(element, column.key) }}
                            </td>

                            <td v-if="column?.key == 'actions'" width="300">
                                <template v-for="(btn, i) in element[column.key]" :key="i">
                                    <component :is="btn?.RejectButton" v-bind="btn.props"></component>
                                    <component :is="btn?.ApproveButton" v-bind="btn.props"></component>
                                    <component :is="btn?.LinkForm" v-bind="btn.props"></component>
                                    <component :is="btn?.BlockButton" v-bind="btn.props"></component>
                                    <component :is="btn?.PremiumUserButton" v-bind="btn.props"></component>
                                    <component :is="btn?.ManageSearchButton" v-bind="btn.props"></component>
                                    <component :is="btn?.AttachButton" v-bind="btn.props"></component>
                                    <component :is="btn?.EditButton" v-bind="btn.props"></component>
                                    <component :is="btn?.ViewButton" v-bind="btn.props"></component>
                                    <component :is="btn?.DeleteButton" v-bind="btn.props"></component>
                                    <component :is="btn?.PasswordButton" v-bind="btn.props"></component>
                                    <component :is="btn?.ClosedButton" v-bind="btn.props"></component>
                                    <component :is="btn?.ReopenButton" v-bind="btn.props"></component>
                                    <component :is="btn?.StatusButton" v-bind="btn.props"></component>
                                </template>
                            </td>
                        </template>
                        <template v-else>
                            <td></td>
                        </template>
                    </template>
                </tr>
            </template>
        </draggable>
    </template>
    <template v-else>
        <tbody v-if="rows.length">
            <tr v-for="row in tableRows" :key="row.id">
                <template v-for="column in tableHeader" :key="column.key">
                    <template v-if="column?.key">
                        <td v-if="column.hasOwnProperty('titleCase') && !column.key.includes('.')">
                            {{ titleCase(row[column.key]) }}
                        </td>
                        <td v-if="
                column?.key != 'actions' &&
                !column.hasOwnProperty('titleCase') &&
                !column.key.includes('.')
              ">
                            {{ row[column.key] }}
                        </td>
                        <td v-if="column?.key != 'actions' && column.key.includes('.')">
                            {{ evaluate(row, column.key) }}
                        </td>

                        <td v-if="column?.key == 'actions'" width="300">
                            <template v-for="(btn, i) in row[column.key]" :key="i">
                                <component :is="btn?.RejectButton" v-bind="btn.props"></component>
                                <component :is="btn?.ApproveButton" v-bind="btn.props"></component>
                                <component :is="btn?.LinkForm" v-bind="btn.props"></component>
                                <component :is="btn?.BlockButton" v-bind="btn.props"></component>
                                <component :is="btn?.PremiumUserButton" v-bind="btn.props"></component>
                                <component :is="btn?.ManageSearchButton" v-bind="btn.props"></component>
                                <component :is="btn?.AttachButton" v-bind="btn.props"></component>
                                <component :is="btn?.EditButton" v-bind="btn.props"></component>
                                <component :is="btn?.ViewButton" v-bind="btn.props"></component>
                                <component :is="btn?.DeleteButton" v-bind="btn.props"></component>
                                <component :is="btn?.PasswordButton" v-bind="btn.props"></component>
                                <component :is="btn?.ClosedButton" v-bind="btn.props"></component>
                                <component :is="btn?.ReopenButton" v-bind="btn.props"></component>
                                <component :is="btn?.StatusButton" v-bind="btn.props"></component>
                            </template>
                        </td>
                    </template>
                    <template v-else>
                        <td></td>
                    </template>
                </template>
            </tr>
        </tbody>
    </template>
    <tbody v-if="!rows.length">
        <tr>
            <td style="text-align: center">No Result Found</td>
        </tr>
    </tbody>
</table>
<div class="pagination pull-right" v-if="rows.length">
    <a v-if="meta.current_page > 0" :class="{ 'btn btn-sm': true, 'btn-primary': meta.current_page > 0 }" @click="
        updateCurrentPage({ currentPage: parseInt(meta.current_page) - 1, section })
      ">Prev</a>
    &nbsp;
    <template v-for="(link, index) in meta.links" :key="index">
        <a @click="updateCurrentPage({ currentPage: parseInt(link.label), section })" v-if="!['pagination.previous', 'pagination.next'].includes(link.label)" :class="{
          'btn btn-sm': true,
          'btn-outline-primary': !link.active,
          'bg-primary disabled': link.active,
        }">{{ link.label }}</a>&nbsp;
    </template>

    <a v-if="meta.current_page < meta.last_page" :class="{ 'btn btn-sm': true, 'btn-primary': meta.current_page < meta.last_page }" @click="
        updateCurrentPage({ currentPage: parseInt(meta.current_page) + 1, section })
      ">Next
    </a>
</div>
</template>

<script>
import {
    mapActions,
    mapState
} from "vuex";
import _ from "lodash";
import draggable from "vuedraggable";
import { postRequest } from '@/store/api';
export default {
    name: 'ITable',
    components: {
        draggable
    },
    data() {
        return {
            rows_per_page: 10,
            dragging: false
        }
    },
    props: {
        classes: Array,
        columns: Array,
        rows: Array,
        meta: Object,
        section: String,
        perPageLimit: Boolean,
        dragStatus: {
            default: false,
            type: Boolean
        },
        tableId : {
            default : 'myItableId',
            type : String
        }
    },

    computed: {
        ...mapState('helpers', ['sortable', 'filterCriteria']),
        tableClasses() {
            return this.classes.join(" ");
        },
        tableHeader() {
            return this.columns;
        },
        tableRows() {
            return this.rows;
        },
        tableMeta() {
            return this.meta;
        },
    },
    watch: {
        sortable(to, from) {
            console.log("Now Sortable chnaged", to, from)
        },
        filterCriteria(to, from) {
            console.log("filterCriteria chnaged", to, from)
        },

    },
    inject: ['show', 'hide'],
    methods: {
            async moveColumn(e){
                let oTable = this.$refs[this.tableId];
                let data = [...oTable.rows].map(t => [...t.children].map(u => u.innerText));
                if(data.length > 2){
                    data = data.splice(2, data.length); 
                    data = data.map(i=>i[0])   // getting only ids
                    
                    let fd = new FormData();
                      data.forEach(item => {
                        fd.append('campaignIds[]', item);
                    });
                    
                    let responseData =  await postRequest('admin/campaign/reOrdering',fd);
                    if(responseData.status === 200 || responseData.status === 201) {
                        this.show('Campaign Re-ordered Successfully','success', 3000);
                    } else {
                        this.show(responseData,'error', 3000);
                    }
                }
            },
        ...mapActions("helpers", ["updateCurrentPage", "sortIt", "updatePerRow", "toggleFilter", "updateFilter"]),
        _toggleFilter() {

        },
        filterByKey(event, filterCol) {
            if (event.target.value === "0") {
                console.log("before", this.filterCriteria, filterCol.filter);
                let _filterCriteria = this.filterCriteria.filter(item => {
                    console.log('item.filterKey!=filterCol.filter.filterable', item.filterKey != filterCol.filter.filterable);
                    return item.filterKey != filterCol.filter.filterable
                });
                console.log(this.filterCriteria);
                this.updateFilter(_filterCriteria);
                return;
            }
            console.log('filterByKey', event, filterCol);
            let payload = {
                filterKey: filterCol.filter.filterable,
                filterOperator: "EQUAL",
                filterVal: event.target.value
            };
            let isExisting = this.filterCriteria.findIndex(item => item.filterKey == payload.filterKey)
            //console.log('isExisting',isExisting);
            //console.log('payload',payload);
            if (isExisting !== -1) {
                console.log('payload TO Up', isExisting);
                this.filterCriteria[isExisting] = payload;
            } else {
                this.filterCriteria.push(payload);
            }
            //console.log('GOING TO UP',this.filterCriteria);
            this.updateFilter(this.filterCriteria);
        },
        filterByVal(event, filterCol) {
            console.log('filterByKey', event, filterCol);
            let payload = {
                filterKey: filterCol.filter.filterable,
                filterOperator: "EQUAL",
                filterVal: event.target.key
            };
            let isExisting = this.filterCriteria.findIndex(item => item.filterKey == payload.filterKey)
            //console.log('isExisting',isExisting);
            //console.log('payload',payload);
            if (isExisting !== -1) {
                console.log('payload TO Up', isExisting);
                this.filterCriteria[isExisting] = payload;
            } else {
                this.filterCriteria.push(payload);
            }
            //console.log('GOING TO UP',this.filterCriteria);
            this.updateFilter(this.filterCriteria);
        },
        evaluate(row, key) {
            return _.get(row, key);
        },
        nextPage() {
            console.log("Nxt clicked");
            this.meta.currentPage++;
        },
        titleCase(str) {
            var splitStr = str.toLowerCase().split(" ");
            for (var i = 0; i < splitStr.length; i++) {
                // You do not need to check if i is larger than splitStr length, as your for does that for you
                // Assign it back to the array
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }
            // Directly return the joined string
            return splitStr.join(" ");
        },
    },
};
</script>
