import Vue from "vue";
import Vuex from "vuex";

import home from "./home.module";
import Store from "./index.js";

Vue.use(Vuex);

export async function fetchGames (opts) {
    Store.commit('setGamesAreLoading', true);

    const games = await window.fetch(`/get_paginated_games?page=${opts.page}&limit=${opts.pageSize}&whitePlayerFilter=${opts.args.whitePlayerFilter}&blackPlayerFilter=${opts.args.blackPlayerFilter}&resultFilter=${opts.args.resultFilter}`)
        .then(response => {
            Store.commit('setGamesAreLoading', false);
            return response.json();
        })
        .catch((error) => {
            Store.commit('setGamesAreLoading', false);
            this.dispatch('SHOW_GLOBAL_ERROR_MESSAGE', error.response.data.message);
            return {
                total: 0,
                data: [],
            };
        });

    if (games[0]) {
        return {
            total: games[0].total,
            data: games[0].items
        }
    }
    else
    {
        return {
            total: 0,
            data: []
        }
    }

}

export async function fetchFavouriteGames (opts) {
    Store.commit('setGamesAreLoading', true);

    const games = await window.fetch(`/get_paginated_favourite_games?page=${opts.page}&limit=${opts.pageSize}`)
        .then(response => {
            Store.commit('setGamesAreLoading', false);
            return response.json();
        })
        .catch((error) => {
            Store.commit('setGamesAreLoading', false);
            this.dispatch('SHOW_GLOBAL_ERROR_MESSAGE', error.response.data.message);
            return {
                total: 0,
                data: [],
            };
        });

    if (games[0]) {
        return {
            total: games[0].total,
            data: games[0].items
        }
    }
    else
    {
        return {
            total: 0,
            data: []
        }
    }
}

export default new Vuex.Store({
    modules: {
        home
    }
});
