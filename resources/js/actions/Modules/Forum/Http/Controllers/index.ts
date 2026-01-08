import ForumController from './ForumController'
import LockThreadsController from './LockThreadsController'
import ThreadSubScriptionController from './ThreadSubScriptionController'
import SearchController from './SearchController'
import ThreadController from './ThreadController'
import ReplyController from './ReplyController'
import BestReplyController from './BestReplyController'
import FavoriteController from './FavoriteController'
import Api from './Api'
import RegisterConfirmationController from './RegisterConfirmationController'
import Users from './Users'
import Settings from './Settings'

const Controllers = {
    ForumController: Object.assign(ForumController, ForumController),
    LockThreadsController: Object.assign(LockThreadsController, LockThreadsController),
    ThreadSubScriptionController: Object.assign(ThreadSubScriptionController, ThreadSubScriptionController),
    SearchController: Object.assign(SearchController, SearchController),
    ThreadController: Object.assign(ThreadController, ThreadController),
    ReplyController: Object.assign(ReplyController, ReplyController),
    BestReplyController: Object.assign(BestReplyController, BestReplyController),
    FavoriteController: Object.assign(FavoriteController, FavoriteController),
    Api: Object.assign(Api, Api),
    RegisterConfirmationController: Object.assign(RegisterConfirmationController, RegisterConfirmationController),
    Users: Object.assign(Users, Users),
    Settings: Object.assign(Settings, Settings),
}

export default Controllers