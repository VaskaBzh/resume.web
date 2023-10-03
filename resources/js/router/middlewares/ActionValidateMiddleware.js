export async function ActionValidateMiddleware(route, router) {
    if (route.query?.action) {
        const actionData = {
            password: "login",
            email: "login",
        };

        router.push({
            name: actionData[route.query.action],
            query: {
                action: route.query.action,
                user_id: route.query.user_id,
                hash: route.query.hash,
            },
        })
    }
}
