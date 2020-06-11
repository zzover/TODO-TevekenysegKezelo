export let host         = "http://localhost";
export let useraction   = "/rest/useraction.php";
export let signin       = "/rest/sign-in.php";
export let signup       = "/rest/sign-up.php";

export const Languages = {
    HU: {'AJAXError': 'A kérés feldoldozása sikertelen.', 'Y': ' éve', 'M': ' hónapja', 'D': ' napja', 'h': ' órája', 'm': ' perce', 's': ' másodperce', 'justNow': 'Épp most', 'Confirm': 'Valóban törölni szeretné? A műveletet nem lehet visszavonni.', 'incoming':' ismerősnek jelölt.', 'invite': 'Jelölés', 'sent': 'Jelölve', 'noIncoming': 'Nincs bejövő értesítése.', 'areFriends': 'Már barát', 'negativeTime': 'A határidő nem lehet korábbi mint a kezdeti idő.', 'infoTooLong': 'A projekt leírása túl hosszú! Max. 100 karakter', 'infoNotSet': 'Nincs leírás', 'ownProjects': 'Saját projekt', 'sharedWithMe': 'Velem megosztott projekt', 'inProgressActivity': 'Folyamatban lévő tevékenység', 'doneActivity': 'Befejezett tevékenység', 'count': 'db'},
    EN: {'AJAXError': 'Cannot process this request.', 'Y': ' year(s) ago', 'M': ' month(s) ago', 'D': ' day(s) ago', 'h': ' hour(s) ago', 'm': ' minute(s) ago', 's': ' second(s) ago', 'justNow': 'Just now', 'Confirm': 'Do you really want to delete this? You can\'t undo this.', 'incoming': ' sent you a request.', 'invite': 'Send request', 'sent': 'Sent', 'noIncoming': 'No incoming notifications.', 'areFriends': 'Is a friend', 'negativeTime': 'Deadline can\'t be earlier than the start time.', 'infoTooLong': 'Project info too long! Max. 100 characters', 'infoNotSet': 'No information', 'ownProjects': 'Own projects', 'sharedWithMe': 'Projects shared with me', 'inProgressActivity': 'Activities in progress', 'doneActivity': 'Activities completed', 'count': '#'},
}

export function timeSince(date) {
        let seconds = Math.floor(((new Date().getTime()/1000) - (Date.parse(date) / 1000))),
        interval = Math.floor(seconds / 31536000);
    
        if (interval > 1) return interval + this.Languages[document.documentElement.lang]["Y"];
    
        interval = Math.floor(seconds / 2592000);
        if (interval > 1) return interval + this.Languages[document.documentElement.lang]["M"];
    
        interval = Math.floor(seconds / 86400);
        if (interval >= 1) return interval + this.Languages[document.documentElement.lang]["D"];
    
        interval = Math.floor(seconds / 3600);
        if (interval >= 1) return interval + this.Languages[document.documentElement.lang]["h"];
    
        interval = Math.floor(seconds / 60);
        if (interval >= 1) return interval + this.Languages[document.documentElement.lang]["m"];
    
        if (seconds == 0)
        {
            return this.Languages[document.documentElement.lang]["justNow"];
        }
        return Math.floor(seconds) + this.Languages[document.documentElement.lang]["s"];
}