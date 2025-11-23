import ThreadController from './ThreadController'
import ActivityController from './ActivityController'
import ReplyController from './ReplyController'

const Settings = {
    ThreadController: Object.assign(ThreadController, ThreadController),
    ActivityController: Object.assign(ActivityController, ActivityController),
    ReplyController: Object.assign(ReplyController, ReplyController),
}

export default Settings