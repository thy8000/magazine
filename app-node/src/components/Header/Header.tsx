import { useQuery, gql } from "@apollo/client";
import Image  from 'next/image';
import { CustomLogoFragment, ThemeOptionsHeaderFragment } from '../../fragments/_index';

export default function Header() {
    const { data } = useQuery(Header.query);

    const customLogo = data?.customLogo ?? [];
    const headerCategories = getHeaderCategories(data);

    return (
        <header className="flex bg-header">
            <div className="container">
                <div className="flex justify-evenly">
                    <div>
                        { customLogo.url !== null &&(
                            <Image
                                className="w-auto"
                                src={customLogo.url}
                                alt={customLogo.description}
                                width={customLogo.width ?? 256}
                                height={customLogo.height ?? 79}
                            />
                        )}        
                    </div>

                    { headerCategories && (
                        <div>
                            <ul className="flex justify-center items-center gap-8 h-full">
                                {headerCategories?.map((category: any) => (
                                    <li key={category.term_id}>
                                        <a href="#">{category.name}</a>
                                    </li>
                                ))}
                            </ul>
                        </div>
                    ) }

                    <div></div>
                </div>
            </div>
        </header>
    );
}

function getHeaderCategories(data: any) {
    const themeOptionsHeader = data?.themeOptionsHeader ?? [];

    if(themeOptionsHeader.categoriesList === undefined) {
        return;
    }

    const headerCategories = JSON.parse(themeOptionsHeader.categoriesList) ?? [];

    return headerCategories;
}

Header.query = gql`
    {
        customLogo {
            ...CustomLogoFragment
        }
        themeOptionsHeader {
            ...ThemeOptionsHeaderFragment
        }
    }
    ${CustomLogoFragment}
    ${ThemeOptionsHeaderFragment}
`;