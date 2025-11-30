import threads from './threads'
import activity from './activity'
import reply from './reply'
import avatar from './avatar'

const settings = {
    threads: Object.assign(threads, threads),
    activity: Object.assign(activity, activity),
    reply: Object.assign(reply, reply),
    avatar: Object.assign(avatar, avatar),
}

export default settings