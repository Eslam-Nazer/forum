import ForumController from './ForumController'
import ThreadController from './ThreadController'
import ReplyController from './ReplyController'
import FavoriteController from './FavoriteController'
import ThreadSubScriptionController from './ThreadSubScriptionController'
import Api from './Api'
import Users from './Users'
import Settings from './Settings'

const Controllers = {
    ForumController: Object.assign(ForumController, ForumController),
    ThreadController: Object.assign(ThreadController, ThreadController),
    ReplyController: Object.assign(ReplyController, ReplyController),
    FavoriteController: Object.assign(FavoriteController, FavoriteController),
    ThreadSubScriptionController: Object.assign(ThreadSubScriptionController, ThreadSubScriptionController),
    Api: Object.assign(Api, Api),
    Users: Object.assign(Users, Users),
    Settings: Object.assign(Settings, Settings),
}

export default Controllers