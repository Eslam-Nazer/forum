import ThreadController from './ThreadController'
import ActivityController from './ActivityController'

const Settings = {
    ThreadController: Object.assign(ThreadController, ThreadController),
    ActivityController: Object.assign(ActivityController, ActivityController),
}

export default Settings