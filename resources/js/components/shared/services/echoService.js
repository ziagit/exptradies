export class EchoService {
    static listen(chatRoom, event, callBack) {
        Echo.connector.pusher.config.auth.headers[
            "Authorization"
        ] = `Bearer ${localStorage.getItem("token")}`;
        return Echo.private(chatRoom).listen(event,
            callBack)
    }


    static notification(identifier, callBack) {
        Echo.private(identifier).notification(callBack);
    }
}
