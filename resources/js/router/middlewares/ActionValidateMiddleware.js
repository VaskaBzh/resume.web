export async function ActionValidateMiddleware(route, router) {
    if (route.query?.action) {
        const actionData = {
            password: "settings",
            email: "login",
        };

        router.push({
            name: actionData[route.query.action],
            query: {
                action: route.query.action,
            },
        })
    }
}
