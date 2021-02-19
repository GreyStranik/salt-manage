import {LocaleText} from "@material-ui/data-grid";

interface LocaleTextEx extends LocaleText{
    filterPanelInputLabel: string,
    filterPanelInputPlaceholder? : string
}

export const RU_LOCALE_TEXT: LocaleTextEx = {
    // Root
    rootGridLabel: 'grid',
    noRowsLabel: 'Нет данных',
    errorOverlayDefaultLabel: 'Ошибка',

    // Density selector toolbar button text
    toolbarDensity: 'Density',
    toolbarDensityLabel: 'Density',
    toolbarDensityCompact: 'Compact',
    toolbarDensityStandard: 'Standard',
    toolbarDensityComfortable: 'Comfortable',

    // Columns selector toolbar button text
    toolbarColumns: 'Колонки',
    toolbarColumnsLabel: 'Показать выбор колонок',

    // Filters toolbar button text
    toolbarFilters: 'Фильтры',
    toolbarFiltersLabel: 'Show Filters',
    toolbarFiltersTooltipHide: 'Hide Filters',
    toolbarFiltersTooltipShow: 'Show Filters',
    toolbarFiltersTooltipActive: (count) => `${count} active filter(s)`,

    // Columns panel text
    columnsPanelTextFieldLabel: 'Поиск колонок',
    columnsPanelTextFieldPlaceholder: 'Название колонки',
    columnsPanelDragIconLabel: 'Изменить порядок',
    columnsPanelShowAllButton: 'Показать все',
    columnsPanelHideAllButton: 'Скрыть все',

    // Filter panel text
    filterPanelAddFilter: 'Add Filter',
    filterPanelDeleteIconLabel: 'Delete',
    filterPanelOperators: 'Сравнение',
    filterPanelOperatorAnd: 'And',
    filterPanelOperatorOr: 'Or',
    filterPanelColumns: 'Колонки',
    filterPanelInputLabel: 'Значение',
    filterPanelInputPlaceholder: 'Значение фильтра',

    // Filter operators text
    // filterOperatorContains: 'contains',
    // filterOperatorEquals: 'equals',
    // filterOperatorStartsWith: 'starts with',
    // filterOperatorEndsWith: 'ends with',
    // filterOperatorIs: 'is',
    // filterOperatorNot: 'is not',
    // filterOperatorOnOrAfter: 'is on or after',
    // filterOperatorBefore: 'is before',
    // filterOperatorOnOrBefore: 'is on or before',

    // Column menu text
    columnMenuLabel: 'Меню',
    columnMenuShowColumns: 'Показать колонки',
    columnMenuFilter: 'Фильтр',
    columnMenuHideColumn: 'Скрыть',
    columnMenuUnsort: 'Сброс',
    columnMenuSortAsc: 'По возрастанию',
    columnMenuSortDesc: 'По убыванию',

    // Column header text
    columnHeaderFiltersTooltipActive: (count) => `${count} active filter(s)`,
    columnHeaderFiltersLabel: 'Показать фильтры',
    columnHeaderSortIconLabel: 'Сортировка',

    // Rows selected footer text
    footerRowSelected: (count) =>
        count !== 1
            ? `${count.toLocaleString()} rows selected`
            : `Выбрана ${count.toLocaleString()} строка`,

    // Total rows footer text
    footerTotalRows: 'Всего строк:',

    // Pagination footer text
    footerPaginationRowsPerPage: 'Строк на странице:',
};