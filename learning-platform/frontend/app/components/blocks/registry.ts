/** Content block types for pages and the page builder. */
export const contentBlockTypes = [
  { id: 'hero', label: 'Hero' },
  { id: 'rich-text', label: 'Rich text' },
  { id: 'features', label: 'Features' },
  { id: 'cta', label: 'CTA' },
  { id: 'faq', label: 'FAQ' }
] as const

export type ContentBlockId = (typeof contentBlockTypes)[number]['id']
