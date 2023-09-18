import { LayoutsViewEnum } from "@/layouts/enums/LayoutsViewEnum";

export async function LoadLayoutMiddleware(route) {
    const layout = route.meta.layout;
    const layoutName = LayoutsViewEnum.getLayout(layout);

    const component = await import(`../../layouts/${layoutName}.vue`);
    route.meta.layoutComponent = component.default;
}
