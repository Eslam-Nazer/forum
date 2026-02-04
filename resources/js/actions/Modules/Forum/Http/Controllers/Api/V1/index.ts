import AvatarController from './AvatarController'
import MentionsController from './MentionsController'

const V1 = {
    AvatarController: Object.assign(AvatarController, AvatarController),
    MentionsController: Object.assign(MentionsController, MentionsController),
}

export default V1