export interface ThreadForm {
    channel_id: string;
    title: string;
    body: string;
    recaptcha_token: string;
}

export interface ReplyForm {
    body: string;
}
