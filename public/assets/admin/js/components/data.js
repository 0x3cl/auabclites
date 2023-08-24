export async function get_visitors() {
    const response = await fetch('/api/v1/view/visitors');
    const data = await response.json();
    return data;
}

export async function get_referrers() {
    const response = await fetch('/api/v1/view/referrers');
    const data = await response.json();
    return data;
}