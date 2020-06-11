import * as core from './core.js';

export default function AJAXCall(URL, type, data, noResult, isResult, errorMsg) {
    $.ajax({
        url: core.host + URL,
        'type': type,
        'processData': false,
        'contentType': 'application/json',
        'data': JSON.stringify(data),
        success: function(response)
        {
            if (!response.actionStatus)
            {
                noResult(response);
            }
            else
            {
                isResult(response);
            }
        },
        error: function(error)
        {
            errorMsg(core.Languages[document.documentElement.lang]["AJAXError"]);

            console.log("Debug: ");
            console.log(error);
        }
    });
}