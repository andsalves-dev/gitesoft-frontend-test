import axios from 'axios';
import {GET_HOME_WEATHERS} from "../reducers/weatherReducer";
import {LOADING_WEATHER} from "../reducers/weatherReducer";
import {CLEAR_LOCATIONS} from "../reducers/weatherReducer";

export function fetchLocation(woeid) {
    return (dispatch) => {
        dispatch({
            type: GET_HOME_WEATHERS,
            payload: {location: null, woeid: woeid}
        });

        axios.get(`http://localhost:8001/weather.php/?command=location&woeid=${woeid}`).then(response => {
            dispatch({
                type: GET_HOME_WEATHERS,
                payload: {location: response.data, woeid: woeid}
            });
            dispatch(loading(false));
        }).catch(error => {
            console.log(error.response);
        });
    };
}

export function fetchSearch(keyword) {
    return (dispatch) => {
        dispatch(loading());
        dispatch({type: CLEAR_LOCATIONS});

        axios.get(`http://localhost:8001/weather.php/?command=search&keyword=${keyword}`).then(response => {
            if (response.data instanceof Array) {
                if (!response.data.length) {
                    return dispatch(loading(false));
                }

                for (let i = 0; i < response.data.length; i++) {
                    fetchLocation(response.data[i]['woeid'])(dispatch);
                }
            }
        }).catch(error => {
            console.log(error.response);
        });
    };
}

export function loading(loading = true) {
    return {type: LOADING_WEATHER, payload: {loading: loading}};
}