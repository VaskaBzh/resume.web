import { LayoutsViewEnum } from "@/layouts/enums/LayoutsViewEnum";

export async function LoadLayoutMiddleware(route) {
    const layout = route.meta.link;
    const layoutName = LayoutsViewEnum.getLayout(layout);

    const component = await import(`../../layouts/${layoutName}`);
    route.meta.layoutComponent = component.default;
}
