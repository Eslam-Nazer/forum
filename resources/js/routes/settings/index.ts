import threads from './threads'
import activity from './activity'
import reply from './reply'

const settings = {
    threads: Object.assign(threads, threads),
    activity: Object.assign(activity, activity),
    reply: Object.assign(reply, reply),
}

export default settings